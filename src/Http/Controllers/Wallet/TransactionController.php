<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wallets = Wallet::forHolder($user)->get();

        $transactions = Transaction::where('ref_type','wallet')->latest()->paginate();

        return view("ledger-foundation::wallet.transactions", compact('wallets', 'transactions'));
    }
}
