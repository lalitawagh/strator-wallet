<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
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

    public function store(Request $request)
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $data = $request->validate([
            'wallet'            => 'required',
            'currency'          => 'required',
            'amount'            => 'required',
            'payment_method'    => 'required',
            'description'       => 'required',
        ]);

        $asset_type = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $data['currency']);
        $workspace = Workspace::findOrFail($request->input('workspace_id'));

        if(is_null($asset_type))
        {
            return back()->withError('Currency not exists');
        }

        $data['amount'] = $data['amount'];

        if(session('exchange_rate'))
        {
            $data['amount'] = session('exchange_rate') * $data['amount'];
        }

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

        if(is_null($details))
        {
            return redirect()->route('dashboard.wallet.deposit.create');
        }

        return view("ledger-foundation::wallet.deposit.deposit-detail", compact('details'));
    }

    public function storeDepositOverviewDetail()
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $details = session('deposit_request');

        if(is_null($details))
        {
            return redirect()->route('dashboard.wallet.deposit.create');
        }

        return redirect()->route('dashboard.wallet.deposit-payment',['workspace_id' => $details['workspace_id']]);
    }

    public function showDepositPayment()
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
                    'reference' => $depositRequest['description'],
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
                ],
            ]);

            $wallet = Wallet::find($depositRequest['wallet']);
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
                "description" => $depositRequest['description'],
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

            $amount = $depositRequest['amount'] - ($response['data']['transaction_fee']/100);

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
                    'reference' => $depositRequest['description'],
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
                ],
            ]);

            $wallet = Wallet::find($depositRequest['wallet']);
            $wallet->credit($amount);
        }
        return response()->json(['status' => 'success']);
    }

    public function showFinalDepositDetail()
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $details = session('deposit_request');
        return view("ledger-foundation::wallet.deposit.deposit-final",compact('details'));
    }

    public function showDepositMoney()
    {
        $this->authorize(DepositPolicy::CREATE, Wallet::class);

        $workspace_id = session()->get('deposit_request.workspace_id');
        session()->forget(['fee', 'exchange_rate', 'exchange_currency', 'base_currency', 'wallet', 'currency', 'amount' ,'deposit_request']);

        return redirect()->route('dashboard.wallet.deposit.index',['filter' => ['workspace_id' => $workspace_id]]);
    }
}
