<?php

namespace Riteserve\LedgerFoundation\Http\Controllers\Wallet;

use Kanexy\Cms\Controllers\Controller;

class PayoutController extends Controller
{
    public function index()
    {
        return view("ledger-foundation::wallet.payout.index");
    }

    public function create()
    {
        return view("ledger-foundation::wallet.payout.payouts");
    }
}
