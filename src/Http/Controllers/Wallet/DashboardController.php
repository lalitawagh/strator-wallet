<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Kanexy\Cms\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view("ledger-foundation::wallet.dashboard");
    }
}