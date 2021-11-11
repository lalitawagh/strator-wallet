<?php

namespace Riteserve\LedgerFoundation\Http\Controllers\Wallet;

use Riteserve\Cms\Controllers\Controller;

class DisputeController extends Controller
{
    public function index()
    {
        return view("ledger-foundation::wallet.dispute");
    }
}
