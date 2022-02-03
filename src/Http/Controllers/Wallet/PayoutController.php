<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;

class PayoutController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where("ref_type", 'wallet')->latest()->paginate();

        return view("ledger-foundation::wallet.payout.index", compact('transactions'));
    }

    public function create()
    {
        return view("ledger-foundation::wallet.payout.payouts");
    }
}
