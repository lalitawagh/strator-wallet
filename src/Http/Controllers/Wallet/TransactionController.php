<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Policies\DepositPolicy;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize(DepositPolicy::VIEW, Wallet::class);

        $transactionType = 'all';
        $user = Auth::user();
        $wallets = Wallet::forHolder($user)->get();
        $walletID = $workspace = null;

        if ($request->has('filter.workspace_id')) {
            $workspace = Workspace::findOrFail($request->input('filter.workspace_id'));
        }

        // $transactions = QueryBuilder::for(Transaction::class)
        //     ->allowedFilters([
        //         AllowedFilter::exact('workspace_id'),
        //     ]);

        // if ($request->has('wallet_id')) {
        //     $walletID = $request->input('wallet_id');
        //     $transactions = $transactions->where("ref_id", $walletID);
        // }

        $transactions = Transaction::orWhere('ref_type', 'wallet')->orWhere('meta->transaction_type','wallet-withdraw')->latest()->paginate();

        return view("ledger-foundation::wallet.transactions", compact('workspace', 'wallets', 'transactions', 'walletID', 'transactionType'));
    }
}
