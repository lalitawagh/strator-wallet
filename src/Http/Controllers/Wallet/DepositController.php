<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Entities\AssetType;
use Kanexy\LedgerFoundation\Entities\Wallet;
use Kanexy\LedgerFoundation\Http\Enums\AssetCategoryEnum;

class DepositController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wallets = Wallet::forHolder($user)->with('ledger')->get();
        $currencies = AssetType::whereAssetCategory(AssetCategoryEnum::FIAT_CURRENCY)->get();

        return view("ledger-foundation::wallet.deposit.deposit-initial", compact('wallets', 'currencies'));
    }

    public function depositInitial()
    {
        return view("ledger-foundation::wallet.deposit.deposit-initial");
    }

    public function storeDepositInitial(Request $request)
    {
        $data = $request->validate([
            'wallet'            => 'required',
            'currency'          => 'required',
            'amount'            => 'required',
            'payment_method'    => 'required'
        ]);
        $data['fee'] = 2;

        session(['deposit_request' => $data]);

        return redirect()->route('dashboard.ledger-foundation.wallet.deposit-detail');
    }

    public function depositDetail()
    {
        $details = session('deposit_request');

        return view("ledger-foundation::wallet.deposit.deposit-detail", compact('details'));
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
