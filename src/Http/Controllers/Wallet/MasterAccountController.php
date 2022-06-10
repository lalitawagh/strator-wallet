<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Http\Helper;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\InternationalTransfer\Http\Requests\StoreMasterAccountRequest;

class MasterAccountController extends Controller
{
    public function index()
    {
        $master_accounts =  Helper::paginate(collect(Setting::getValue('wallet_master_accounts', [])));

        return view("ledger-foundation::master-account.index", compact('master_accounts'));
    }

    public function create()
    {
        $countries = Country::get();

        return view("ledger-foundation::master-account.create", compact('countries'));
    }

    public function store(StoreMasterAccountRequest $request)
    {
        $data = $request->validated();
        $data['id'] = now()->format('dmYHis');

        $settings = collect(Setting::getValue('wallet_master_accounts',[]))->push($data);

        Setting::updateOrCreate(['key' => 'wallet_master_accounts'], ['value' => $settings]);

        return redirect()->route('dashboard.wallet.master-account.index')->with([
            'status' => 'success',
            'message' => 'Master account created successfully.',
        ]);
    }
}