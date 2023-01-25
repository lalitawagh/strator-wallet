<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\PartnerFoundation\Core\Models\Transaction;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Policies\PayoutPolicy;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize(PayoutPolicy::VIEW, Payout::class);

        $transactionType = 'all';
        $user = Auth::user();
        $wallets = Wallet::where('type','wallet')->get();
        $walletID = $workspace = null;

        if ($request->has('filter.workspace_id')) {
            $workspace = Workspace::findOrFail($request->input('filter.workspace_id'));
            $wallets = Wallet::forHolder($workspace)->where('type','wallet')->get();
        }

        $transactions = Transaction::where('meta->account','wallet')->latest()->paginate();
        
        return view("ledger-foundation::wallet.transactions", compact('workspace', 'wallets', 'transactions', 'walletID', 'transactionType'));
    }
}
