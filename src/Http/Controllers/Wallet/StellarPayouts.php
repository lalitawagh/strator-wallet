<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\PartnerFoundation\Cxrm\Models\Contact;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;

class StellarPayouts extends Controller
{
    public function index()
    {
        return view('ledger-foundation::wallet.stellar.payouts.index');
    }

    public function create(Request $request)
    {

        $user = Auth::user();
        $countryWithFlags = Country::orderBy("name")->get();
        $countries = Country::get();
        $defaultCountry = Country::find(Setting::getValue("wallet_default_country"));
        $workspace = Workspace::findOrFail($request->input('filter.workspace_id'));
        $wallets =  Wallet::forHolder($workspace)->get();
        $ledgers = Ledger::get();
        $asset_types = Setting::getValue('asset_types', []);
        $beneficiaries = ($request->input('type') == 'transfer') ? Contact::beneficiaries()->verified()->forWorkspace($workspace)->whereRefType('wallet')->whereMobile($user->phone)->latest()->get() : Contact::beneficiaries()->verified()->forWorkspace($workspace)->whereRefType('wallet')->latest()->get();

        return view("ledger-foundation::wallet.stellar.payouts.create", compact('countryWithFlags', 'defaultCountry', 'user', 'workspace', 'beneficiaries', 'ledgers', 'wallets', 'asset_types', 'countries'));

    }

    public function store()
    {

    }
}

