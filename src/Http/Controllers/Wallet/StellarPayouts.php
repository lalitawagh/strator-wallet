<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $wallets =  Wallet::forHolder($workspace)->get();
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

        session(['stellar_request' => $data]);
        
        return redirect()->route('dashboard.wallet.stellar-payment-otp-confirmation',['workspace_id' => $data['workspace_id']]);
    }

    public function showStellarOtpConfirmation()
    {
        $details = session('stellar_request');
        $countryWithFlags = Country::orderBy("name")->get();
        $defaultCountry = Country::find(Setting::getValue("wallet_default_country"));

        $user = Auth::user();
        if(config('services.disable_sms_service') == false){
            $user->notify(new SmsOneTimePasswordNotification($user->generateOtp("sms")));
        }
        else{
            $user->generateOtp("sms");
        }

        if (is_null($details)) {
            return redirect()->route('dashboard.wallet.stellar-payouts.create', ['filter' => ['workspace_id' => $details['workspace_id']]]);
        }

        return view("ledger-foundation::wallet.deposit.deposit-otp-confirmation", compact('details', 'countryWithFlags', 'defaultCountry', 'user'));
    }

    public function getPaymentView()
    {
        $stellarPayoutDetails = session('stellar_request');
        
        return view("ledger-foundation::wallet.stellar.payouts.payment",compact('stellarPayoutDetails'));
    }

    public function storePaymentDetails(Request $request)
    {
        $data = $request->validate([
            'card_number' => ['required'],
            'year' => ['required'],
            'month' => ['required'],
            'cvc' => ['required'], 
        ]);

        $stellarPayoutDetails = session('stellar_request');
        $stellarPayoutDetails['card_details'] = $data;

        session(['stellar_request' => $stellarPayoutDetails]);
        
        $user = Auth::user();

        $beneficiary = Contact::find($stellarPayoutDetails['beneficiary']);
        $stellarAccount = Wallet::whereHolderId($stellarPayoutDetails['workspace_id'])->whereType('steller')->first();
       
        $transaction = Transaction::create([
            'urn' => Transaction::generateUrn(),
            'amount' => $stellarPayoutDetails['amount'],
            'workspace_id' => $stellarPayoutDetails['workspace_id'],
            'type' => 'credit',
            'payment_method' => 'stripe',
            'note' => null,
            'ref_id' => $stellarAccount->urn,
            'ref_type' => 'stellar',
            'settled_amount' =>$stellarPayoutDetails['amount'],
            'settled_currency' => $stellarPayoutDetails['wallet'],
            'settlement_date' => date('Y-m-d'),
            'settled_at' => now(),
            'initiator_id' => optional($user)->getKey(),
            'initiator_type' => optional($user)->getMorphClass(),
            'transaction_fee' =>  0,
            'status' => TransactionStatus::PENDING_CONFIRMATION,
            'note' => $stellarPayoutDetails['note'],
            'meta' => [
                'reference' => $stellarPayoutDetails['reference'],
                'sender_name' => $user->getFullName(),
                'beneficiary_id' => $beneficiary->id,
                'beneficiary_ref_type' => 'stellar',
                'beneficiary_name' => $beneficiary->getFullName(),
                'sender_currency' => $stellarPayoutDetails['wallet'],
                'receiver_currency' => $stellarPayoutDetails['receiver_currency'],
                'exchange_rate' => null,
                'transaction_type' => 'deposit',
                'transfer_status' => 'pending',
                'account' => 'stellar',
            ],
        ]);

        if (!empty($request->has('attachment'))) {

            $transaction->update(['attachment' => $request->file('attachment')->store('Images', 'azure')]);
        }

        $meta = [
            'amount' => $stellarPayoutDetails['amount'],
            'sender_currency' => $stellarPayoutDetails['wallet'],
            'receiver_currency' => $stellarPayoutDetails['receiver_currency'],
            'exchange_rate' =>  null,
            'workspace_id' => $stellarPayoutDetails['workspace_id'],
            'type' => 'credit',
            'payment_method' => 'stripe',
            'ref_id' => $stellarAccount->urn,
            'ref_type' => 'stellar',
            'settled_amount' => $stellarPayoutDetails['amount'],
            'settled_currency' =>$stellarPayoutDetails['wallet'],
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

        $exchangeApi = [
            'transaction_id' => $transaction->id,
            'amount' => $stellarPayoutDetails['amount'],
            'type' => 0,
            'conversion_currency' => $stellarPayoutDetails['receiver_currency'],
            'beneficiary_public_key' => $beneficiary->meta['beneficiary_public_key'],
            'card_number' => $data['card_number'],
            'year' => $data['year'],
            'month' => $data['month'],
            'cvc' => $data['cvc'],
            'currency' => $stellarPayoutDetails['wallet'],
        ];
       
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
        }
        
        return redirect()->route('dashboard.wallet.stellar-dashboard', ['filter' => ['workspace_id' => $stellarPayoutDetails['workspace_id']]])->with(['message' => 'Processing the payment. It may take a while.', 'status' => 'success']);
    }

}

