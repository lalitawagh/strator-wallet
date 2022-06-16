<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Policies\DepositPolicy;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;

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

        $transactions = Transaction::orWhere('ref_type', 'wallet')->orWhere('meta->transaction_type','withdraw')->latest()->paginate();

        return view("ledger-foundation::wallet.transactions", compact('workspace', 'wallets', 'transactions', 'walletID', 'transactionType'));
    }
}
