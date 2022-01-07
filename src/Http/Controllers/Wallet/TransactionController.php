<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Kanexy\Cms\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        return view("ledger-foundation::wallet.transactions");
    }
}
