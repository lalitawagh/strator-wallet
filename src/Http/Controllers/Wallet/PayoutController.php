<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\Setting\Models\Setting;

class PayoutController extends Controller
{
    public function index()
    {
        return view("ledger-foundation::wallet.payout.index");
    }

    public function create()
    {
        $user = Auth::user();
        $countryWithFlags = Country::orderBy("name")->get();
        $defaultCountry = Country::find(Setting::getValue("default_country"));

        return view("ledger-foundation::wallet.payout.payouts",compact('countryWithFlags', 'defaultCountry', 'user'));
    }
}
