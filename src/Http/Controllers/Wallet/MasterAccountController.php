<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Http\Helper;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\LedgerFoundation\Contracts\MasterAccount;
use Kanexy\LedgerFoundation\Http\Requests\StoreMasterAccountRequest;
use Kanexy\LedgerFoundation\Policies\MasterAccountPolicy;

class MasterAccountController extends Controller
{
    public function index()
    {
        $this->authorize(MasterAccountPolicy::VIEW, MasterAccount::class);

        $master_accounts =  Helper::paginate(collect(Setting::getValue('wallet_master_accounts', [])));

        return view("ledger-foundation::master-account.index", compact('master_accounts'));
    }

    public function create()
    {
        $this->authorize(MasterAccountPolicy::CREATE, MasterAccount::class);

        $countries = Country::get();

        return view("ledger-foundation::master-account.create", compact('countries'));
    }

    public function store(StoreMasterAccountRequest $request)
    {
        $data = $request->validated();

        $existCountry = collect(Setting::getValue('wallet_master_accounts', []))->where('country', $data['country'])->first();

        if (!is_null($existCountry)) {
            return back()->withError('Master Account alreday exists with this country');
        }
    
        $data['id'] = now()->format('dmYHis');

        $settings = collect(Setting::getValue('wallet_master_accounts',[]))->push($data);

        Setting::updateOrCreate(['key' => 'wallet_master_accounts'], ['value' => $settings]);

        return redirect()->route('dashboard.wallet.master-account.index')->with([
            'status' => 'success',
            'message' => 'Master account created successfully.',
        ]);
    }

    public function edit($id)
    {
        $this->authorize(MasterAccountPolicy::EDIT, MasterAccount::class);

        $master_account = collect(Setting::getValue('wallet_master_accounts',[]))->firstWhere('id', $id);
        $countries = Country::get();

        return view("ledger-foundation::master-account.edit", compact('master_account', 'countries'));
    }

    public function update(StoreMasterAccountRequest $request,$id)
    {
        $data = $request->validated();
        $data['id'] = $id;

        $existCountry = collect(Setting::getValue('wallet_master_accounts', []))->where('country', $data['country'])->first();

        if (!is_null($existCountry) && ($id != $existCountry['id'])) {
            return back()->withError('Master Account alreday exists with this country');
        }

        $settings = collect(Setting::getValue('wallet_master_accounts'))->map(function ($item) use ($id,$data) {
            if ($item['id'] == $id) {
                return $data;
            }

            return $item;
        });

        Setting::updateOrCreate(['key' => 'wallet_master_accounts'], ['value' => $settings]);


        return redirect()->route("dashboard.wallet.master-account.index")->with([
            'status' => 'success',
            'message' => 'Master account updated successfully.',
        ]);
    }

    public function destroy($id)
    {
        $this->authorize(MasterAccountPolicy::DELETE, MasterAccount::class);

        $settings = collect(Setting::getValue('wallet_master_accounts', []))->filter(function ($item) use ($id) {
            if ($item['id'] != $id) {
                return true;
            }
            return false;
        });

        Setting::updateOrCreate(['key' => 'wallet_master_accounts'], ['value' => $settings]);

        return redirect()->route("dashboard.wallet.master-account.index")->with([
            'status' => 'success',
            'message' => 'Master account deleted successfully.',
        ]);
    }
}