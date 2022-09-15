<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\Notifications\SmsOneTimePasswordNotification;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Contracts\Payout;
use Kanexy\LedgerFoundation\Http\Requests\StorePayoutRequest;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Policies\PayoutPolicy;
use Kanexy\PartnerFoundation\Banking\Enums\TransactionStatus;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Kanexy\PartnerFoundation\Core\Helper;
use Kanexy\PartnerFoundation\Core\Models\Log;
use Kanexy\PartnerFoundation\Cxrm\Models\Contact;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PayoutController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize(PayoutPolicy::VIEW, Payout::class);

        $workspace = null;
        $transactionType = 'payout';

        if ($request->has('filter.workspace_id')) {
            $workspace = Workspace::findOrFail($request->input('filter.workspace_id'));
        }

        $transactions = QueryBuilder::for(Transaction::class)
            ->allowedFilters([
                AllowedFilter::exact('workspace_id'),
            ]);

        $transactions = $transactions->where('status', '!=', TransactionStatus::PENDING_CONFIRMATION)->where("meta->transaction_type", 'payout')->latest()->paginate();

        return view("ledger-foundation::wallet.payout.index", compact('workspace', 'transactions', 'transactionType'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $countryWithFlags = Country::orderBy("name")->get();
        $countries = Country::get();
        $defaultCountry = Country::find(Setting::getValue("wallet_default_country"));
        $workspace = Workspace::findOrFail($request->input('workspace_id'));
        $wallets =  Wallet::forHolder($user)->get();
        $ledgers = Ledger::get();
        $asset_types = Setting::getValue('asset_types', []);
        $beneficiaries = ($request->input('type') == 'transfer') ? Contact::beneficiaries()->verified()->forWorkspace($workspace)->whereRefType('wallet')->whereMobile($user->phone)->latest()->get() : Contact::beneficiaries()->verified()->forWorkspace($workspace)->whereRefType('wallet')->latest()->get();

        return view("ledger-foundation::wallet.payout.payouts", compact('countryWithFlags', 'defaultCountry', 'user', 'workspace', 'beneficiaries', 'ledgers', 'wallets', 'asset_types','countries'));
    }

    public function store(StorePayoutRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        $sender_wallet = Wallet::with('ledger')->find($data['wallet']);

        $receiver_ledger = Wallet::find($data['receiver_currency']);
        $beneficiary = Contact::find($data['beneficiary']);
        $beneficiary_user = User::wherePhone($beneficiary?->mobile)->first();

        if($sender_wallet->id == $receiver_ledger->id && $beneficiary_user->getKey() == $user->getKey())
        {
            return back()->withError("Payout not process with same wallet");
        }

        $beneficiary_wallet = NULL;
        if (isset($beneficiary_user)) {
            $beneficiary_wallet = Wallet::forHolder($beneficiary_user)->whereLedgerId($receiver_ledger?->ledger_id)->first();
        }

        $amount = $data['amount'];

        if ($amount > $data['balance']) {
            return back()->withError("Insufficient balance in the account.");
        }

        if (is_null($beneficiary_wallet)) {
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
            'settled_currency' => session('payout_base_currency') ? session('payout_base_currency') : null,
            'settlement_date' => date('Y-m-d'),
            'settled_at' => now(),
            'initiator_id' => optional($user)->getKey(),
            'initiator_type' => optional($user)->getMorphClass(),
            'transaction_fee' => session('payout_fee') ? session('payout_fee') : 0,
            'status' => TransactionStatus::PENDING_CONFIRMATION,
            'note' => $data['note'],
            'meta' => [
                'reference' => $data['reference'],
                'sender_ref_id' => $data['wallet'],
                'sender_ref_type' => 'wallet',
                'sender_name' => $user->getFullName(),
                'beneficiary_id' => $beneficiary->id,
                'beneficiary_ref_id' => $beneficiary_wallet->id,
                'beneficiary_ref_type' => 'wallet',
                'beneficiary_name' => $beneficiary->getFullName(),
                'sender_currency' => session('payout_base_currency') ? session('payout_base_currency') : null,
                'receiver_currency' => session('payout_exchange_currency') ? session('payout_exchange_currency') : null,
                'exchange_rate' => session('payout_exchange_rate') ? session('payout_exchange_rate') : null,
                'transaction_type' => 'payout',
                'balance' => $sender_wallet?->balance ? ($sender_wallet?->balance - ($amount)) : 0,
                'transfer_status' => 'pending',
                'account' => 'wallet',
            ],
        ]);

        if (!empty($request->has('attachment'))) {

            $transaction->update(['attachment' => $request->file('attachment')->store('Images', 'azure')]);
        }

        $meta = [
            'amount' => $amount,
            'sender_currency' => session('payout_base_currency'),
            'receiver_currency' => session('payout_exchange_currency'),
            'exchange_rate' => session('payout_exchange_rate') ? session('payout_exchange_rate') : null,
            'workspace_id' => $data['workspace_id'],
            'type' => 'debit',
            'payment_method' => 'wallet',
            'ref_id' =>  $data['wallet'],
            'ref_type' => 'wallet',
            'settled_amount' => $amount,
            'settled_currency' => session('payout_base_currency') ? session('payout_base_currency') : null,
            'settlement_date' => date('Y-m-d'),
            'transaction_fee' => session('payout_fee') ? session('payout_fee') : 0,
            'status' => 'accepted',
        ];

        $log = new Log();
        $log->id = Str::uuid();
        $log->text = 'transaction';
        $log->user_id = auth()->user()->id;
        $log->meta = $meta;
        $log->target()->associate($transaction);
        $log->save();

        $transaction->notify(new SmsOneTimePasswordNotification($transaction->generateOtp("sms")));
        //$transaction->generateOtp("sms");
        return $transaction->redirectForVerification(URL::temporarySignedRoute('dashboard.wallet.payout-verify', now()->addMinutes(30), ["id" => $transaction->id]), 'sms');
    }

    public function verify(Request $request)
    {
        $transaction = Transaction::find($request->query('id'));
        $amount =  ($transaction->meta['exchange_rate']) ? (($transaction->amount - $transaction->transaction_fee) / $transaction->meta['exchange_rate']) : ($transaction->amount - $transaction->transaction_fee);
        $debit_amount =  $transaction->amount;
        $sender_wallet = Wallet::find($transaction->meta['sender_ref_id']);
        $beneficiary_wallet = Wallet::find($transaction->meta['beneficiary_ref_id']);
        $beneficiary_user = User::find($beneficiary_wallet->holder_id);
        $beneficiary_workspace = $beneficiary_user->workspaces()->first();

        $creditTransaction = Transaction::create([
            'urn' => Transaction::generateUrn(),
            'amount' => $amount,
            'workspace_id' => $beneficiary_workspace->id,
            'type' => 'credit',
            'payment_method' => 'wallet',
            'note' => null,
            'ref_id' => $transaction->meta['beneficiary_ref_id'],
            'ref_type' => 'wallet',
            'settled_amount' => $amount,
            'settled_currency' => $transaction->meta['receiver_currency'],
            'settlement_date' => date('Y-m-d'),
            'settled_at' => now(),
            'transaction_fee' => $transaction->fee,
            'status' => TransactionStatus::ACCEPTED,
            'note' => $transaction->note,
            'attachment' => $transaction?->attachment ? $transaction->attachment : null,
            'meta' => [
                'reference' => $transaction->meta['reference'],
                'sender_ref_id' => $transaction->meta['sender_ref_id'],
                'sender_ref_type' => 'wallet',
                'sender_name' => $transaction->meta['sender_name'],
                'beneficiary_id' => $transaction->meta['beneficiary_id'],
                'beneficiary_ref_id' => $transaction->meta['beneficiary_ref_id'],
                'beneficiary_ref_type' => 'wallet',
                'beneficiary_name' => $transaction->meta['beneficiary_name'],
                'sender_currency' => $transaction->meta['sender_currency'],
                'receiver_currency' => $transaction->meta['receiver_currency'],
                'exchange_rate' => $transaction->meta['exchange_rate'],
                'transaction_type' => 'payout',
                'balance' => $beneficiary_wallet?->balance ? ($beneficiary_wallet?->balance + $amount) : 0,
                'transfer_status' => $transaction->meta['transfer_status'],
                'account' => 'wallet',
            ],
        ]);



        $transaction->status = 'accepted';
        $transaction->update();

        $meta = [
            'amount' => $amount,
            'sender_currency' => $creditTransaction->meta['sender_currency'],
            'receiver_currency' =>  $creditTransaction->meta['receiver_currency'],
            'exchange_rate' => $creditTransaction->meta['exchange_rate'],
            'workspace_id' => $beneficiary_workspace->id,
            'type' => 'credit',
            'payment_method' => 'wallet',
            'ref_id' => $transaction->meta['beneficiary_ref_id'],
            'ref_type' => 'wallet',
            'settled_amount' => $amount,
            'settled_currency' => $transaction->meta['receiver_currency'],
            'settlement_date' => date('Y-m-d'),
            'transaction_fee' => $transaction->fee,
            'status' => 'accepted',
        ];

        $log = new Log();
        $log->id = Str::uuid();
        $log->text = 'transaction';
        $log->user_id = auth()->user()->id;
        $log->meta = $meta;
        $log->target()->associate($creditTransaction);
        $log->save();


        $sender_wallet->debit($debit_amount);
        $beneficiary_wallet->credit($amount);

        session()->forget(['payout_fee', 'payout_exchange_rate', 'payout_exchange_currency', 'payout_base_currency', 'payout_wallet', 'payout_currency']);

        return redirect()->route("dashboard.wallet.payout.index", ['filter' => ['workspace_id' => $transaction->workspace_id]])->with([
            'message' => 'Processing the payment. It may take a while.',
            'status' => 'success',
        ]);
    }

    public function transferAccepted(Request $request)
    {
        $transaction = Transaction::find($request->id);

        $metaDetails = [
            'transfer_status' =>  TransactionStatus::ACCEPTED,
        ];

        $metaInfo = $transaction?->meta ? array_merge($transaction?->meta,$metaDetails) : $metaDetails;

        $transaction->meta = $metaInfo;
        $transaction->update();

        if($request->type == 'all')
        {
            return redirect()->route('dashboard.wallet.transaction.index')->with([
                'status' => 'success',
                'message' => 'The payout request accepted successfully.',
            ]);
        }else
        {
            return redirect()->route('dashboard.wallet.payout.index')->with([
                'status' => 'success',
                'message' => 'The payout request accepted successfully.',
            ]);
        }
    }
}
