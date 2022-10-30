<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $wallets = Wallet::whereHolderId($workspace->id)->get();
        $transactions = Transaction::where("workspace_id", $workspace?->id)->where('meta->account','wallet')->latest()->take(5)->get();

        return view("ledger-foundation::wallet.dashboard", compact('transactions', 'workspace', 'wallets'));
    }
}
