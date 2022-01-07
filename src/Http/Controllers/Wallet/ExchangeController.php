<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Kanexy\Cms\Controllers\Controller;

class ExchangeController extends Controller
{
    public function index()
    {
        return view("ledger-foundation::wallet.exchange");
    }
}
