<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\Notifications\SmsOneTimePasswordNotification;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Http\Requests\WithdrawRequest;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\PartnerFoundation\Banking\Enums\TransactionStatus;
use Kanexy\PartnerFoundation\Banking\Models\Account;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Kanexy\PartnerFoundation\Banking\Services\PayoutService;
use Kanexy\PartnerFoundation\Cxrm\Models\Contact;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class WithdrawController extends Controller
{
    private PayoutService $payoutService;

    public function __construct(PayoutService $payoutService)
    {
        $this->payoutService = $payoutService;
    }

    public function index(Request $request)
    {
        /** @var $user App\Model\User */
        $user = Auth::user();
        $workspace = null;
        $transactionType = 'withdraw';

        if ($request->has('filter.workspace_id')) {
            $workspace = Workspace::findOrFail($request->input('filter.workspace_id'));
        }

        $transactions = Transaction::where(["meta->transaction_type" => $transactionType])->latest()->paginate();

        if($user->isSubscriber())
        {
            $transactions = Transaction::where(["meta->transaction_type" => $transactionType,'initiator_id' => $user->id])->latest()->paginate();
        }


        return view("ledger-foundation::wallet.withdraw.index", compact('workspace', 'transactions', 'user'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $countryWithFlags = Country::orderBy("name")->get();
        $defaultCountry = Country::find(Setting::getValue("wallet_default_country"));
        $workspace = Workspace::findOrFail($request->input('workspace_id'));
        $wallets =  Wallet::forHolder($user)->get();
        $beneficiaries = Contact::beneficiaries()->verified()->forWorkspace($workspace)->whereRefType('wrappex')->where(['meta->beneficiary_type' => 'withdraw'])->latest()->get();
        $ledgers = Ledger::get();
        $asset_types = Setting::getValue('asset_types', []);

        return view("ledger-foundation::wallet.withdraw.create", compact('countryWithFlags', 'defaultCountry', 'user', 'workspace', 'beneficiaries', 'ledgers', 'wallets', 'asset_types'));
    }

    public function store(WithdrawRequest $request)
    {
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $ukMasterAccount =  collect(Setting::getValue('wallet_master_accounts',[]))->firstWhere('country', 231);
        $wallet = Wallet::find($request->input('sender_wallet_account_id'));
        $asset_type = collect(Setting::getValue('asset_types', []))->firstWhere('id', $wallet->ledger->asset_type);

        /** @var Account $sender */
        $sender = Account::whereAccountNumber($ukMasterAccount['account_number'])->first();

        /** @var Contact $beneficiary */
        $beneficiary = Contact::findOrFail($request->input('beneficiary_id'));
        // dd($beneficiary);

        $transaction = $this->payoutService->initialize($sender, $beneficiary, $request->validated());
        $metaDetails = [
            'sender_wallet_account_id' => $request->input('sender_wallet_account_id'),
            'transaction_type' => 'withdraw',
            'sender_currency' => $asset_type['name'] ? $asset_type['name'] : null,
            'receiver_currency' => 'GBP',
            'account' => 'wallet',
        ];

        $meta = array_merge($transaction->meta,$metaDetails);
        $transaction->workspace_id = $workspace->id;
        $transaction->meta = $meta;
        $transaction->update();

        $transaction->notify(new SmsOneTimePasswordNotification($transaction->generateOtp("sms")));

        return $transaction->redirectForVerification(URL::temporarySignedRoute('dashboard.wallet.withdraw.verify', now()->addMinutes(30), ["id" => $transaction->id]), 'sms');
    }

    public function verify(Request $request)
    {
        $transaction = Transaction::find($request->query('id'));
        $wallet = Wallet::findOrFail($transaction->meta['sender_wallet_account_id']);
        $balance = ($wallet->balance - $transaction->amount);
        try {

            $wallet->balance = $balance;
            $wallet->update();
        } catch (\Exception $exception) {
            if ($exception->getCode() === 500) {
                return redirect()->route("dashboard.wallet.withdraw.index", ['filter' => ["workspace_id" => $transaction->workspace_id]])->with([
                    'message' => 'Something went wrong. Please try again later.',
                    'status' => 'failed',
                ]);
            }

            throw $exception;
        }

        return redirect()->route("dashboard.wallet.withdraw.index", ['filter' => ['workspace_id' => $transaction->workspace_id]])->with([
            'message' => 'Processing the payment. It may take a while.',
            'status' => 'success',
        ]);
    }

    public function withdrawAccepted(Request $request)
    {
        $transaction = Transaction::find($request->id);
        $this->payoutService->process($transaction);

        if($request->type == 'all')
        {
            return redirect()->route('dashboard.wallet.transaction.index')->with([
                'status' => 'success',
                'message' => 'The withdraw request transaction processing the payment.It may take a while.',
            ]);
        }else
        {
            return redirect()->route('dashboard.wallet.withdraw.index')->with([
                'status' => 'success',
                'message' => 'The withdraw request transaction processing the payment.It may take a while.',
            ]);
        }


    }
}
