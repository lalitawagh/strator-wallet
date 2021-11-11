<?php

namespace Riteserve\LedgerFoundation\Http\Controllers\Wallet;

use Riteserve\Cms\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        return view("ledger-foundation::wallet.transactions");
    }
}
