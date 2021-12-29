<?php

namespace Riteserve\LedgerFoundation\Http\Controllers\Wallet;

use Kanexy\Cms\Controllers\Controller;

class WithdrawController extends Controller
{
    public function index()
    {
        return view("ledger-foundation::wallet.withdraw");
    }
}
