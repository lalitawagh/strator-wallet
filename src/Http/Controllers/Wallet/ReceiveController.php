<?php

namespace Riteserve\LedgerFoundation\Http\Controllers\Wallet;

use Riteserve\Cms\Controllers\Controller;

class ReceiveController extends Controller
{
    public function index()
    {
        return view("ledger-foundation::wallet.request.index");
    }

    public function create()
    {
        return view("ledger-foundation::wallet.request.receives");
    }
}
