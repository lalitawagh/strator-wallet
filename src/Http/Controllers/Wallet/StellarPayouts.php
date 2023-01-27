<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\Notifications\SmsOneTimePasswordNotification;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Dtos\ExchangeToCryptoDto;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\PartnerFoundation\Cxrm\Models\Contact;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;
use Kanexy\LedgerFoundation\Http\Requests\StoreStellarPayoutRequest;
use Kanexy\LedgerFoundation\Services\StellerService;
use Kanexy\PartnerFoundation\Core\Enums\TransactionStatus;
use Kanexy\PartnerFoundation\Core\Models\Transaction;
use Illuminate\Support\Str;
use Kanexy\PartnerFoundation\Core\Models\Log;

class StellarPayouts extends Controller
{
    protected StellerService $stellerService;

    public function __construct(StellerService $stellerService)
    {
        $this->stellerService = $stellerService;
    }

    public function index()
    {
        return view('ledger-foundation::wallet.stellar.payouts.index');
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $countryWithFlags = Country::orderBy("name")->get();
        $countries = Country::get();
        $defaultCountry = Country::find(Setting::getValue("wallet_default_country"));
        $workspace = Workspace::findOrFail($request->input('filter.workspace_id'));
        $wallets =  Wallet::forHolder($workspace)->with('ledger')->get();
        $ledgers = Ledger::whereExchangeType('fiat')->get();
        $stellarCurrencies = ['USDC','XLM','ETH','YUSDC'];
        $asset_types = Setting::getValue('asset_types', []);
        $beneficiaries = Contact::beneficiaries()->verified()->forWorkspace($workspace)->whereRefType('stellar')->latest()->get();

        return view("ledger-foundation::wallet.stellar.payouts.create", compact('countryWithFlags', 'defaultCountry', 'user', 'workspace', 'beneficiaries', 'ledgers', 'wallets', 'asset_types', 'countries', 'stellarCurrencies'));

    }

    public function store(StoreStellarPayoutRequest $request)
    {
        $data = $request->validated();
        $data['type'] = 'stellar';

        $user = Auth::user();

        $beneficiary = Contact::find($data['beneficiary']);
        $stellarAccount = Wallet::whereHolderId($data['workspace_id'])->whereType('steller')->first();
        $senderCurrency = Wallet::with('ledger')->find($data['wallet']);
       
        $transaction = Transaction::create([
            'urn' => Transaction::generateUrn(),
            'amount' => $data['amount'],
            'workspace_id' => $data['workspace_id'],
            'type' => 'debit',
            'payment_method' => 'stripe',
            'note' => null,
            'ref_id' =>  $data['wallet'],
            'ref_type' => 'wallet',
            'settled_amount' =>$data['amount'],
            'settled_currency' => $senderCurrency?->ledger?->name,
            'settlement_date' => date('Y-m-d'),
            'settled_at' => now(),
            'initiator_id' => optional($user)->getKey(),
            'initiator_type' => optional($user)->getMorphClass(),
            'transaction_fee' =>  0,
            'status' => TransactionStatus::PENDING_CONFIRMATION,
            'note' => $data['note'],
            'meta' => [
                'reference' => $data['reference'],
                'sender_name' => $user->getFullName(),
                'beneficiary_id' => $beneficiary->id,
                'beneficiary_ref_type' => 'stellar',
                'beneficiary_name' => $beneficiary->getFullName(),
                'sender_wallet_account_id' => $data['wallet'],
                'sender_currency' => $senderCurrency?->ledger?->name,
                'receiver_currency' => $data['receiver_currency'],
                'exchange_rate' => null,
                'transaction_type' => 'payout',
                'transfer_status' => 'pending',
                'balance' => 0,
                'account' => 'stellar',
            ],
        ]);

        if (!empty($request->has('attachment'))) {

            $transaction->update(['attachment' => $request->file('attachment')->store('Images', 'azure')]);
        }

        $meta = [
            'amount' => $data['amount'],
            'sender_currency' => $senderCurrency?->ledger?->name,
            'receiver_currency' => $data['receiver_currency'],
            'exchange_rate' =>  null,
            'workspace_id' => $data['workspace_id'],
            'type' => 'debit',
            'payment_method' => 'stripe',
            'ref_id' => $stellarAccount->urn,
            'ref_type' => 'stellar',
            'settled_amount' => $data['amount'],
            'settled_currency' =>$senderCurrency?->ledger?->name,
            'settlement_date' => date('Y-m-d'),
            'transaction_fee' =>  0,
            'status' => 'accepted',
        ];

        $log = new Log();
        $log->id = Str::uuid();
        $log->text = 'transaction';
        $log->user_id = auth()->user()->id;
        $log->meta = $meta;
        $log->target()->associate($transaction);
        $log->save();

        if (config('services.disable_sms_service') == false) {
            $transaction->notify(new SmsOneTimePasswordNotification($transaction->generateOtp("sms")));
        } else {
            $transaction->generateOtp("sms");
        }

        return $transaction->redirectForVerification(URL::temporarySignedRoute('dashboard.wallet.stellar-payout-verify', now()->addMinutes(30), ["id" => $transaction->id]), 'sms');

    }

    public function verify(Request $request)
    {
        $transaction = Transaction::find($request->query('id'));
        $beneficiary = Contact::find($transaction?->meta['beneficiary_id']);
       
        $exchangeApi = [
            'transaction_id' => $transaction->id,
            'amount' => $transaction->amount,
            'type' => 0,
            'conversion_currency' => $transaction?->meta['receiver_currency'],
            'beneficiary_public_key' => $beneficiary->meta['beneficiary_public_key'],
            'card_number' => config('services.card_number'),
            'year' =>  config('services.card_year'),
            'month' =>  config('services.card_month'),
            'cvc' =>  config('services.card_cvc'),
            'currency' => $transaction->settled_currency,
        ];
        // dd($exchangeApi);
        $details = $this->stellerService->exchangeToCrypto(
            new ExchangeToCryptoDto($exchangeApi)
        );

        $beneificaryAccount = Wallet::where('meta->publicKey',$beneficiary->meta['beneficiary_public_key'])->whereType('steller')->first();
       
        if($details['message'] != 'Invalid Input' && !is_null($beneificaryAccount))
        {
           
            if(!is_null($beneificaryAccount))
            {
                $stellarBalance = $this->stellerService->getBalance($beneficiary->meta['beneficiary_public_key']);
                if(isset($stellarBalance['balance']))
                {
                    $beneificaryAccount->balance = $stellarBalance['balance'][0]['balance'];
                    $beneificaryAccount->update();
                }
            }
            
            $senderWallet = Wallet::find($transaction->meta['sender_wallet_account_id']);
            $senderWallet->debit($transaction->amount);

            $metaDetails = ['balance' => ($senderWallet->balance > $transaction->amount) ? ($senderWallet->balance - $transaction->amount) : 0];
            $meta = array_merge($transaction->meta, $metaDetails);

            $transaction->status = 'accepted';
            $transaction->meta = $meta;
            $transaction->update();

        }

        return redirect()->route('dashboard.wallet.stellar-dashboard', ['filter' => ['workspace_id' => $transaction->workspace_id]])->with(['message' => 'Processing the payment. It may take a while.', 'status' => 'success']);
    }


    

}

