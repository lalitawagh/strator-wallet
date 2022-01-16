<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\PartnerFoundation\Banking\Models\Account;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wallets = Account::whereDivision('wallet')->get();

        return view("ledger-foundation::wallet.transactions", compact('wallets'));
    }
}
