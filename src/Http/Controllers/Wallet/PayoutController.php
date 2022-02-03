<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Http\Requests\StorePayoutRequest;
use Kanexy\LedgerFoundation\Model\ExchangeRate;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Policies\PayoutPolicy;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Kanexy\PartnerFoundation\Cxrm\Models\Contact;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;

class PayoutController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize(PayoutPolicy::VIEW, Wallet::class);

        if ($request->has('filter.workspace_id')) {
            $workspace = Workspace::findOrFail($request->input('filter.workspace_id'));
        }

        return view("ledger-foundation::wallet.payout.index", compact('workspace'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $countryWithFlags = Country::orderBy("name")->get();
        $defaultCountry = Country::find(Setting::getValue("default_country"));
        $workspace = Workspace::findOrFail($request->input('workspace_id'));
        $wallets =  Wallet::forHolder($user)->get();
        $beneficiaries = Contact::beneficiaries()->forWorkspace($workspace)->latest()->get();
        $ledgers = Ledger::get();

        return view("ledger-foundation::wallet.payout.payouts",compact('countryWithFlags', 'defaultCountry', 'user', 'workspace', 'beneficiaries', 'ledgers', 'wallets'));
    }

    public function store(StorePayoutRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        $sender_wallet = Wallet::with('ledger')->find($data['wallet']);
        $receiver_ledger = Ledger::whereId($data['receiver_currency'])->first();
        $sender_asset_category = $sender_wallet?->ledger->asset_category;
        $receiver_asset_category = $receiver_ledger->asset_category;

        if(@$sender_asset_category != \Kanexy\LedgerFoundation\Enums\AssetCategory::VIRTUAL &&  @$receiver_asset_category != \Kanexy\LedgerFoundation\Enums\AssetCategory::VIRTUAL)
        {
            $base_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id',$sender_wallet?->ledger->asset_type);
            $exchange_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $receiver_ledger->asset_type);

            $base_currency_name = $base_currency['name'];
            $exchange_currency_name = $exchange_currency['name'];
            $exchange_rate = Currency::convert()->from($base_currency_name)->to($exchange_currency_name)->get();
            $fee = $sender_wallet?->ledger->payout_fee;
        }else{
            $exchange_rate_details = ExchangeRate::where(['base_currency' => $sender_wallet->ledger_id,'exchange_currency' => $receiver_ledger->ledger_id])->first();
            $base_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $sender_wallet?->ledger->asset_type);
            $exchange_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $receiver_ledger->asset_type);

            $base_currency_name = ($sender_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::VIRTUAL) ? 'Coin' : $base_currency['name'];
            $exchange_currency_name = ($exchange_currency['asset_category'] == \Kanexy\LedgerFoundation\Enums\AssetCategory::VIRTUAL) ? 'Coin' : $exchange_currency['name'];
            $exchange_rate =  $exchange_rate_details?->exchange_rate;
            $fee = $exchange_rate_details?->exchange_fee;
        }


        $asset_type = collect(Setting::getValue('asset_types',[]))->firstWhere('id',  $receiver_ledger->asset_type);
        $beneficiary = Contact::find($data['beneficiary']);
        $beneficiary_user = User::wherePhone($beneficiary->mobile)->first();
        $beneficiary_wallet = Wallet::forHolder($beneficiary_user)->whereLedgerId($receiver_ledger->id)->first();
        $amount = $data['amount'] * $exchange_rate;

        if($data['amount'] > $data['balance'])
        {
            return back()->withError("Insufficient balance in the account.");
        }

        if(is_null($beneficiary_wallet))
        {
            return back()->withError("The beneficiary doesn't have this wallet account");
        }

        $transaction = Transaction::create([
            'urn' => Transaction::generateUrn(),
            'amount' => $amount,
            'workspace_id' => $data['workspace_id'],
            'type' => 'debit',
            'payment_method' => 'wallet',
            'note' => null,
            'ref_id' => $data['wallet'],
            'ref_type' => 'wallet',
            'settled_amount' => $amount,
            'settled_currency' => $asset_type['name'],
            'settlement_date' => date('Y-m-d'),
            'settled_at' => now(),
            'transaction_fee' => $fee ?? 0,
            'status' => 'pending',
            'meta' => [
                'sender_ref_id' => $data['wallet'],
                'sender_ref_type' => 'wallet',
                'sender_name' => $user->getFullName(),
                'beneficiary_id' => $beneficiary->id,
                'beneficiary_ref_id' => $beneficiary_wallet->id,
                'beneficiary_ref_type' => 'wallet',
                'beneficiary_name' => $beneficiary->getFullName(),
                'sender_currency' => $base_currency_name,
                'receiver_currency' => $exchange_currency_name,
                'exchange_rate' => $exchange_rate,
                'receiver_currency' => $exchange_currency_name,
            ],
        ]);


        // $transaction->notify(new SmsOneTimePasswordNotification($user->generateOtp("sms")));
        $transaction->generateOtp("sms");

        return $transaction->redirectForVerification(URL::temporarySignedRoute('dashboard.ledger-foundation.wallet-payout-verify', now()->addMinutes(30),["id"=> $transaction->id]), 'sms');
    }

    public function verify(Request $request)
    {
        $transaction = Transaction::find($request->query('id'));
        $amount =  $transaction->amount;

        Transaction::create([
            'urn' => Transaction::generateUrn(),
            'amount' => $transaction->amount,
            'workspace_id' => $transaction->workspace_id,
            'type' => 'credit',
            'payment_method' => 'wallet',
            'note' => null,
            'ref_id' => $transaction->meta['beneficiary_ref_id'],
            'ref_type' => 'wallet',
            'settled_amount' => $transaction->amount,
            'settled_currency' => $transaction->settled_currency,
            'settlement_date' => date('Y-m-d'),
            'settled_at' => now(),
            'status' => 'accepted',
            'meta' => [
                'sender_ref_id' => $transaction->sender_ref_id,
                'sender_ref_type' => 'wallet',
                'sender_name' => $transaction->sender_name,
                'beneficiary_id' => $transaction->beneficiary_id,
                'beneficiary_ref_id' => $transaction->beneficiary_ref_id,
                'beneficiary_ref_type' => 'wallet',
                'beneficiary_name' => $transaction->beneficiary_name,
            ],
        ]);

        $transaction->status ='accepted';
        $transaction->update();

        $sender_wallet = Wallet::find($transaction->meta['sender_ref_id']);
        $sender_wallet->debit($sender_wallet->balance,$amount);

        $beneficiary_wallet = Wallet::find($transaction->meta['beneficiary_ref_id']);
        $beneficiary_wallet->credit($beneficiary_wallet->balance,$amount);

        return redirect()->route("dashboard.ledger-foundation.wallet-payout.index", ['filter' => ['workspace_id' => $transaction->workspace_id]])->with([
            'message' => 'Processing the payment. It may take a while.',
            'status' => 'success',
        ]);
    }
}
