<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\Notifications\SmsOneTimePasswordNotification;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\PartnerFoundation\Core\Models\Transaction;
use Kanexy\LedgerFoundation\Contracts\Withdraw;
use Kanexy\LedgerFoundation\Http\Requests\WithdrawRequest;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Policies\WithdrawPolicy;
use Kanexy\PartnerFoundation\Core\Facades\PartnerFoundation;
use Kanexy\PartnerFoundation\Core\Models\Log;
use Kanexy\PartnerFoundation\Cxrm\Models\Contact;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;

class WithdrawController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize(WithdrawPolicy::VIEW, Withdraw::class);

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
        $this->authorize(WithdrawPolicy::CREATE, Withdraw::class);

        $user = Auth::user();
        $countryWithFlags = Country::orderBy("name")->get();
        $defaultCountry = Country::find(Setting::getValue("wallet_default_country"));
        $workspace = Workspace::findOrFail($request->input('workspace_id'));
        $wallets =  Wallet::forHolder($workspace)->get();
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
        if (!is_null(PartnerFoundation::getBankingPayment($request)) && PartnerFoundation::getBankingPayment($request) == true) {
            $wrappexService = new \Kanexy\Banking\Services\WrappexService();
            $payoutService = new \Kanexy\Banking\Services\PayoutService($wrappexService);
            /** @var Account $sender */
            $sender = \Kanexy\Banking\Models\Account::whereAccountNumber($ukMasterAccount['account_number'])->first();

            /** @var Contact $beneficiary */
            $beneficiary = Contact::findOrFail($request->input('beneficiary_id'));

            $transaction =  $payoutService->initialize($sender, $beneficiary, $request->validated());
        }

        $metaDetails = [
            'sender_wallet_account_id' => $request->input('sender_wallet_account_id'),
            'transaction_type' => 'withdraw',
            'sender_currency' => $asset_type['name'] ? $asset_type['name'] : null,
            'receiver_currency' => 'GBP',
            'account' => 'wallet',
            'balance' => $wallet?->balance ? ($wallet?->balance - ($request->input('amount'))) : 0,
        ];

        $meta = array_merge($transaction->meta,$metaDetails);
        $transaction->workspace_id = $workspace->id;
        $transaction->meta = $meta;
        $transaction->attachment =  $request->has('attachment') ? $request->file('attachment')->store('Images', 'azure'): null;
        $transaction->status = 'draft';
        $transaction->update();

        $meta = [
            'amount' => $transaction->amount,
            'sender_currency' =>  $transaction->meta['sender_currency'],
            'receiver_currency' => $transaction->meta['receiver_currency'],
            'exchange_rate' =>  null,
            'workspace_id' => $workspace->id,
            'type' => 'debit',
            'payment_method' => 'wallet',
            'ref_id' =>  $transaction->meta['sender_wallet_account_id'],
            'ref_type' => 'wallet',
            'settled_amount' => $transaction->amount,
            'settled_currency' => $transaction->meta['sender_currency'] ? $transaction->meta['sender_currency'] : null,
            'settlement_date' => date('Y-m-d'),
            'transaction_fee' => 0,
            'status' => 'accepted',
        ];

        $log = new Log();
        $log->id = Str::uuid();
        $log->text = 'transaction';
        $log->user_id = auth()->user()->id;
        $log->meta = $meta;
        $log->target()->associate($transaction);
        $log->save();

        if(config('services.disable_sms_service') == false){
            $transaction->notify(new SmsOneTimePasswordNotification($transaction->generateOtp("sms")));
        }
        else{
            $transaction->generateOtp("sms");
        }

        return $transaction->redirectForVerification(URL::temporarySignedRoute('dashboard.wallet.withdraw.verify', now()->addMinutes(30), ["id" => $transaction->id]), 'sms');
    }

    public function verify(Request $request)
    {
        $transaction = Transaction::find($request->query('id'));
        $wallet = Wallet::findOrFail($transaction->meta['sender_wallet_account_id']);
        $balance = ($wallet->balance - $transaction->amount);
        try {
            $transaction->status = 'pending-confirmation';
            $transaction->update();

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
        $workspace = Workspace::find($transaction->workspace_id);
        $user = $workspace->users()->first();

        $ukMasterAccount =  collect(Setting::getValue('wallet_master_accounts',[]))->firstWhere('country', 231);
        if (!is_null(PartnerFoundation::getBankingPayment($request)) && PartnerFoundation::getBankingPayment($request) == true) {
            $wrappexService = new \Kanexy\Banking\Services\WrappexService();
            $payoutService = new \Kanexy\Banking\Services\PayoutService($wrappexService);

            $masterAccount = \Kanexy\Banking\Models\Account::whereAccountNumber($ukMasterAccount['account_number'])->first();
            if($masterAccount->balance <  $transaction->amount)
            {
                if($request->type == 'all')
                {
                    return redirect()->route('dashboard.wallet.transaction.index')->with([
                        'status' => 'error',
                        'message' => 'Please add funds to your MTC account.',
                    ]);
                }

                return redirect()->route('dashboard.wallet.withdraw.index')->with([
                    'status' => 'error',
                    'message' => 'Please add funds to your MTC account.',
                ]);
            }

            $payoutService->process($transaction);
        }

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
