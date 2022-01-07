<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Kanexy\Cms\Controllers\Controller;

class DisputeController extends Controller
{
    public function index()
    {
        return view("ledger-foundation::wallet.dispute");
    }
}
