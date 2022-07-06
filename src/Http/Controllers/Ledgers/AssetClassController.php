<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Contracts\AssetClassConfiguration;
use Kanexy\LedgerFoundation\Http\Helper;
use Kanexy\LedgerFoundation\Http\Requests\StoreAssetClassRequest;
use Kanexy\LedgerFoundation\Policies\AssetClassPolicy;

class AssetClassController extends Controller
{
    public function index()
    {
        $this->authorize(AssetClassPolicy::VIEW, AssetClassConfiguration::class);

        $asset_class_lists = Helper::paginate(collect(Setting::getValue('asset_classes', []))->reverse());

        return view("ledger-foundation::asset-class.index", compact('asset_class_lists'));
    }

    public function create()
    {
        $this->authorize(AssetClassPolicy::CREATE, AssetClassConfiguration::class);

        return view("ledger-foundation::asset-class.create");
    }

    public function store(StoreAssetClassRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('walletImages', 'azure');
        }
        $data['status'] = $request->has('status') ? 'active' : 'inactive';
        $data['id'] = now()->format('dmYHis');

        $settings = collect(Setting::getValue('asset_classes', []))->push($data);

        Setting::updateOrCreate(['key' => 'asset_classes'], ['value' => $settings]);

        return redirect()->route("dashboard.wallet.asset-class.index")->with([
            'status' => 'success',
            'message' => 'Asset Class created successfully.',
        ]);
    }

    public function edit($id)
    {
        $this->authorize(AssetClassPolicy::EDIT, AssetClassConfiguration::class);

        $asset_class = collect(Setting::getValue('asset_classes', []))->firstWhere('id', $id);

        return view("ledger-foundation::asset-class.edit", compact('asset_class'));
    }

    public function update(StoreAssetClassRequest $request, $id)
    {
        $data = $request->validated();
        $data['id'] = $id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('walletImages', 'azure');
        }

        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        $settings = collect(Setting::getValue('asset_classes'))->map(function ($item) use ($id, $data) {
            if ($item['id'] == $id) {
                $data['image'] = $data['image'] ?? @$item['image'];
                return $data;
            }

            return $item;
        });

        Setting::updateOrCreate(['key' => 'asset_classes'], ['value' => $settings]);

        return redirect()->route("dashboard.wallet.asset-class.index")->with([
            'status' => 'success',
            'message' => 'Asset Class updated successfully.',
        ]);
    }

    public function destroy($id)
    {
        $this->authorize(AssetClassPolicy::DELETE, AssetClassConfiguration::class);

        $settings = collect(Setting::getValue('asset_classes', []))->filter(function ($item) use ($id) {
            if ($item['id'] != $id) {
                return true;
            }
            return false;
        });

        Setting::updateOrCreate(['key' => 'asset_classes'], ['value' => $settings]);

        return redirect()->route("dashboard.wallet.asset-class.index")->with([
            'status' => 'success',
            'message' => 'Asset Class deleted successfully.',
        ]);
    }
}
