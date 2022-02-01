<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Model\Wallet;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wallets = Wallet::forHolder($user)->get();

        return view("ledger-foundation::wallet.transactions", compact('wallets'));
    }
}
