<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\Notifications\SmsOneTimePasswordNotification;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Http\Requests\StoreDepositRequest;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Policies\DepositPolicy;
use Kanexy\LedgerFoundation\Services\WalletService;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Stripe;

class DepositController extends Controller
{
    private WalletService $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function index(Request $request)
    {
        $this->authorize(DepositPolicy::VIEW, Wallet::class);

        $workspace = null;
        $transactionType = 'deposit';

        if ($request->has('filter.workspace_id')) {
            $workspace = Workspace::findOrFail($request->input('filter.workspace_id'));
        }

        $transactions = QueryBuilder::for(Transaction::class)
            ->allowedFilters([
                AllowedFilter::exact('workspace_id'),
            ]);

        $transactions = $transactions->where("meta->transaction_type", $transactionType)->latest()->paginate();

        return view("ledger-foundation::wallet.deposit.index", compact('workspace', 'transactions', 'transactionType'));
    }

    public function create(Request $request)
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $user = Auth::user();
        $wallets = Wallet::forHolder($user)->with('ledger')->get();
        $currencies = Setting::getValue('asset_types',[]);
        $workspace = Workspace::findOrFail($request->input('workspace_id'));

        return view("ledger-foundation::wallet.deposit.deposit-initial", compact('wallets', 'currencies', 'workspace'));
    }

    public function store(StoreDepositRequest $request)
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $data = $request->validated();

        $asset_type = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $data['currency']);
        $workspace = Workspace::findOrFail($request->input('workspace_id'));

        $data['amount'] = $data['amount'];

        $exchange_ledger = Ledger::whereAssetType($data['currency'])->first();
        $exchange_wallet_details = Wallet::forHolder(Auth::user())->whereLedgerId($exchange_ledger?->id)->first();

        $amount = $data['amount']  + session('fee');

        if($exchange_wallet_details?->balance < $amount && $asset_type['asset_category'] != \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY)
        {
            return back()->withError('Insufficient balance in this wallet account.');
        }

        $data['exchange_currency'] = $data['currency'];
        $data['fee'] = session('fee') ?? 0;
        $data['currency'] = $asset_type['name'];
        $data['workspace_id'] = $workspace->id;
        $data['asset_category'] = $asset_type['asset_category'];

        session(['deposit_request' => $data]);

        return redirect()->route('dashboard.wallet.deposit-overview', ['workspace_id' => $workspace->id]);
    }

    public function showDepositOverview()
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $details = session('deposit_request');
        $exchange_ledger = Ledger::whereAssetType($details['exchange_currency'])->first();

        if(is_null($details))
        {
            return redirect()->route('dashboard.wallet.deposit.create');
        }

        return view("ledger-foundation::wallet.deposit.deposit-detail", compact('details','exchange_ledger'));
    }

    public function storeDepositOverviewDetail()
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $details = session('deposit_request');

        if(is_null($details))
        {
            return redirect()->route('dashboard.wallet.deposit.create');
        }

        return redirect()->route('dashboard.wallet.deposit-otp-confirmation',['workspace_id' => $details['workspace_id']]);
    }


    public function showDepositOtpConfirmation()
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $details = session('deposit_request');
        $countryWithFlags = Country::orderBy("name")->get();
        $defaultCountry = Country::find(Setting::getValue("default_country"));
        $user = Auth::user();
        $user->notify(new SmsOneTimePasswordNotification($user->generateOtp("sms")));
        // $user->generateOtp("sms");
        if(is_null($details))
        {
            return redirect()->route('dashboard.wallet.deposit.create');
        }

        return view("ledger-foundation::wallet.deposit.deposit-otp-confirmation", compact('details', 'countryWithFlags', 'defaultCountry', 'user'));
    }

    public function DepositOtpVerification(Request $request)
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);


    }

    public function showDepositPayment(Request $request)
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $details = session('deposit_request');

        if(is_null($details))
        {
            return redirect()->route('dashboard.wallet.deposit.create');
        }

        return view("ledger-foundation::wallet.deposit.deposit-payment",compact('details'));
    }

    public function paypalPayment(Request $request)
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $data = json_decode($request->getContent(), true);
        $depositRequest = session('deposit_request');

        $user = Auth::user();
        $workspace = $user->workspaces()->first();

        $amount = $depositRequest['amount'];
        if(session('exchange_rate'))
        {
            $amount = ($depositRequest['amount'] * session('exchange_rate'));
        }

        $wallet = Wallet::find($depositRequest['wallet']);

        if($data['status'] == 'COMPLETED')
        {
            Transaction::create([
                'urn' => Transaction::generateUrn(),
                'amount' => $amount,
                'workspace_id' => $workspace->getKey(),
                'type' => 'credit',
                'payment_method' => 'paypal',
                'note' => null,
                'ref_id' => $depositRequest['wallet'],
                'ref_type' => 'wallet',
                'settled_amount' => $amount,
                'settled_currency' => $depositRequest['currency'],
                'settlement_date' => date('Y-m-d'),
                'settled_at' => now(),
                'transaction_fee' => $depositRequest['fee'],
                'status' => 'accepted',
                'meta' => [
                    'reference' => $depositRequest['reference'],
                    'sender_ref_id' => $data['payer_id'],
                    'sender_name' => $data['payer']['name']['given_name'] . ' ' . $data['payer']['name']['surname'],
                    'sender_merchant_id' => $data['paymentDetails'][0]['payee']['merchant_id'],
                    'beneficiary_id' => Auth::user()->id,
                    'beneficiary_ref_id' => $depositRequest['wallet'],
                    'beneficiary_name' => Auth::user()->getFullName(),
                    'transaction_id' => $data['paymentDetails'][0]['payments']['captures'][0]['id'],
                    'exchange_rate' => session('exchange_rate') ? session('exchange_rate') : null,
                    'base_currency' => session('base_currency') ? session('base_currency') : null,
                    'exchange_currency' => session('exchange_currency') ? session('exchange_currency') : null,
                    'transaction_type' => 'deposit',
                    'balance' => ($wallet?->balance + $amount),
                ],
            ]);

            $wallet->credit($amount);
        }

        return response()->json(['status' => 'success']);
    }

    public function stripePayment(Request $request)
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);
        $depositRequest = session('deposit_request');
        $stripe =  Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $data = Stripe\Charge::create ([
                "amount" => $request->input('amount') * 100,
                "currency" => $depositRequest['currency'],
                "source" => $request->input('stripeToken'),
                "description" => $depositRequest['reference'],
        ]);

        $feeDetails = $this->walletService->stripeBalanceTransactionHistoryDetails($data->balance_transaction);

        $data['transaction_fee'] = $feeDetails['fee'];

        return response()->json(['status' => 'success','data' => $data]);

    }


    public function storeStripeDepositPaymentDetails(Request $request)
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $depositRequest = session('deposit_request');
        $response = $request->all();

        if($response['data']['status'] == 'succeeded')
        {
            $user = Auth::user();
            $workspace = $user->workspaces()->first();
            $depositRequest['stripe_fee'] = $response['data']['transaction_fee']/100;
            $depositRequest['stripe_receipt_url'] = $response['data']['receipt_url'];
            session(['deposit_request' => $depositRequest]);

            $amount = ($depositRequest['amount'] - ($response['data']['transaction_fee']/100));
            if(session('exchange_rate'))
            {
                $amount = ($depositRequest['amount'] - ($response['data']['transaction_fee']/100)) * session('exchange_rate');
            }

            $wallet = Wallet::find($depositRequest['wallet']);

            Transaction::create([
                'urn' => Transaction::generateUrn(),
                'amount' => $amount,
                'workspace_id' => $workspace->getKey(),
                'type' => 'credit',
                'payment_method' => 'stripe',
                'note' => null,
                'ref_id' =>  $depositRequest['wallet'],
                'ref_type' => 'wallet',
                'settled_amount' => $amount,
                'settled_currency' => $depositRequest['currency'],
                'settlement_date' => date('Y-m-d'),
                'settled_at' => now(),
                'transaction_fee' => $depositRequest['fee'],
                'status' => 'accepted',
                'meta' => [
                    'reference' => $depositRequest['reference'],
                    'sender_payment_id' => $response['data']['id'],
                    'sender_name' => $response['data']['source']['name'],
                    'sender_card_id' => $response['data']['payment_method'],
                    'sender_card_fingerprint' => $response['data']['source']['fingerprint'],
                    'stripe_balance_transaction' => $response['data']['balance_transaction'],
                    'beneficiary_id' => Auth::user()->id,
                    'beneficiary_ref_id' => $depositRequest['wallet'],
                    'beneficiary_name' => Auth::user()->getFullName(),
                    'stripe_fee' => ($response['data']['transaction_fee'])/100,
                    'stripe_receipt_url' => $response['data']['receipt_url'],
                    'exchange_rate' => session('exchange_rate') ? session('exchange_rate') : null,
                    'base_currency' => session('base_currency') ? session('base_currency') : null,
                    'exchange_currency' => session('exchange_currency') ? session('exchange_currency') : null,
                    'transaction_type' => 'deposit',
                    'balance' => ($wallet?->balance + $amount),
                ],
            ]);

            $wallet->credit($amount);
        }
        return response()->json(['status' => 'success']);
    }

    public function storePaymentDetails(Request $request)
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $user = Auth::user();
        $depositRequest = session('deposit_request');
        $ledger = Ledger::whereAssetType($depositRequest['exchange_currency'])->first();
        $wallet = Wallet::find($depositRequest['wallet']);
        $exchange_wallet_details = Wallet::forHolder($user)->whereLedgerId($ledger->getKey())->first();
        $workspace = $user->workspaces()->first();
        $credit_amount = session('exchange_rate') ? ($depositRequest['amount'] * session('exchange_rate')) : $depositRequest['amount'];
        $debit_amount = ($depositRequest['amount'] + $depositRequest['fee']);
        $beneficiary_user = User::find($exchange_wallet_details->holder_id);
        $beneficiary_workspace = $beneficiary_user->workspaces()->first();



            Transaction::create([
                'urn' => Transaction::generateUrn(),
                'amount' => $credit_amount,
                'workspace_id' => $workspace->getKey(),
                'type' => 'credit',
                'payment_method' => 'wallet',
                'note' => null,
                'ref_id' =>  $depositRequest['wallet'],
                'ref_type' => 'wallet',
                'settled_amount' => $credit_amount,
                'settled_currency' => $depositRequest['currency'],
                'settlement_date' => date('Y-m-d'),
                'settled_at' => now(),
                'transaction_fee' => $depositRequest['fee'],
                'status' => 'accepted',
                'meta' => [
                    'reference' => $depositRequest['reference'],
                    'sender_name' => $exchange_wallet_details->name,
                    'sender_wallet_urn' => $exchange_wallet_details->urn,
                    'beneficiary_id' => Auth::user()->id,
                    'beneficiary_ref_id' => $depositRequest['wallet'],
                    'beneficiary_name' => Auth::user()->getFullName(),
                    'exchange_rate' => session('exchange_rate') ? session('exchange_rate') : null,
                    'base_currency' => session('base_currency') ? session('base_currency') : null,
                    'exchange_currency' => session('exchange_currency') ? session('exchange_currency') : null,
                    'transaction_type' => 'deposit',
                    'balance' => ($wallet?->balance + $credit_amount),
                ],
            ]);

            $wallet->credit($credit_amount);

            Transaction::create([
                'urn' => Transaction::generateUrn(),
                'amount' => $debit_amount,
                'workspace_id' => $beneficiary_workspace->getKey(),
                'type' => 'debit',
                'payment_method' => 'wallet',
                'note' => null,
                'ref_id' =>  $exchange_wallet_details->id,
                'ref_type' => 'wallet',
                'settled_amount' => $debit_amount,
                'settled_currency' => session('exchange_currency') ? session('exchange_currency') : null,
                'settlement_date' => date('Y-m-d'),
                'settled_at' => now(),
                'transaction_fee' => $depositRequest['fee'],
                'status' => 'accepted',
                'meta' => [
                    'reference' => $depositRequest['reference'],
                    'sender_name' => $exchange_wallet_details->name,
                    'sender_wallet_urn' => $exchange_wallet_details->urn,
                    'beneficiary_id' => Auth::user()->id,
                    'beneficiary_ref_id' => $depositRequest['wallet'],
                    'beneficiary_name' => Auth::user()->getFullName(),
                    'exchange_rate' => session('exchange_rate') ? session('exchange_rate') : null,
                    'base_currency' => session('base_currency') ? session('base_currency') : null,
                    'exchange_currency' => session('exchange_currency') ? session('exchange_currency') : null,
                    'transaction_type' => 'deposit',
                    'balance' => ($exchange_wallet_details?->balance - ($debit_amount)),
                ],
            ]);

            $exchange_wallet_details->debit($debit_amount);

        return redirect()->route('dashboard.wallet.deposit-final-detail',['filter' => ['workspace_id' => $workspace->getKey()]]);
    }

    public function showFinalDepositDetail()
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $details = session('deposit_request');
        $exchange_ledger = Ledger::whereAssetType($details['exchange_currency'])->first();

        return view("ledger-foundation::wallet.deposit.deposit-final",compact('details', 'exchange_ledger'));
    }

    public function showDepositMoney()
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $workspace_id = session()->get('deposit_request.workspace_id');
        session()->forget(['fee', 'exchange_rate', 'exchange_currency', 'base_currency', 'wallet', 'currency', 'amount' ,'deposit_request']);

        return redirect()->route('dashboard.wallet.deposit.index',['filter' => ['workspace_id' => $workspace_id]]);
    }
}
