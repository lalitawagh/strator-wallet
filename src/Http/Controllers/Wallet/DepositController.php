<?php

namespace Riteserve\LedgerFoundation\Http\Controllers\Wallet;

use Kanexy\Cms\Controllers\Controller;

class DepositController extends Controller
{
    public function index()
    {
        return view("ledger-foundation::wallet.deposit.deposit-initial");
    }

    public function depositInitial()
    {
        return view("ledger-foundation::wallet.deposit.deposit-initial");
    }

    public function depositDetail()
    {
        return view("ledger-foundation::wallet.deposit.deposit-detail");
    }

    public function depositPayment()
    {
        return view("ledger-foundation::wallet.deposit.deposit-payment");
    }

    public function depositFinal()
    {
        return view("ledger-foundation::wallet.deposit.deposit-final");
    }
}
