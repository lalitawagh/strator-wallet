<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Http\Requests\StoreAssetClassRequest;
use Kanexy\LedgerFoundation\Policies\AssetClassPolicy;

class AssetClassController extends Controller
{
    public function index()
    {
        $this->authorize(AssetClassPolicy::VIEW, Setting::class);

        $asset_class_lists = Setting::getValue('asset_classes',[]);

        return view("ledger-foundation::asset-class.index", compact('asset_class_lists'));
    }

    public function create()
    {
        $this->authorize(AssetClassPolicy::CREATE, Setting::class);

        return view("ledger-foundation::asset-class.create");
    }

    public function store(StoreAssetClassRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('walletImages', 'azure') : 'demo.jpg';
        $data['status'] = $request->has('status') ? 'active' : 'inactive';
        $data['id'] = now()->format('dmYHis');

        $settings = collect(Setting::getValue('asset_classes',[]))->push($data);

        Setting::updateOrCreate(['key' => 'asset_classes'], ['value' => $settings]);

        return redirect()->route("dashboard.ledger-foundation.asset-class.index")->with([
            'status' => 'success',
            'message' => 'Asset Class created successfully.',
        ]);
    }

    public function edit($id)
    {
        $this->authorize(AssetClassPolicy::EDIT, Setting::class);

        $asset_class = collect(Setting::getValue('asset_classes',[]))->firstWhere('id', $id);

        return view("ledger-foundation::asset-class.edit", compact('asset_class'));
    }

    public function update(StoreAssetClassRequest $request,$id)
    {
        $data = $request->validated();
        $data['id'] = $id;
        if($request->hasFile('image'))
        {
            $data['image'] = $request->file('image')->store('walletImages', 'azure');
        }
        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        $settings = collect(Setting::getValue('asset_classes'))->filter(function ($item) use ($id) {
            if ($item['id'] != $id) {
                return true;
            }
            return false;
        });

        $settings->push($data);

        Setting::updateOrCreate(['key' => 'asset_classes'], ['value' => $settings]);

        return redirect()->route("dashboard.ledger-foundation.asset-class.index")->with([
            'status' => 'success',
            'message' => 'Asset Class updated successfully.',
        ]);
    }

    public function destroy($id)
    {
        $this->authorize(AssetClassPolicy::DELETE, Setting::class);

        $settings = collect(Setting::getValue('asset_classes', []))->filter(function ($item) use ($id) {
            if ($item['id'] != $id) {
                return true;
            }
            return false;
        });

        Setting::updateOrCreate(['key' => 'asset_classes'], ['value' => $settings]);

        return redirect()->route("dashboard.ledger-foundation.asset-class.index")->with([
            'status' => 'success',
            'message' => 'Asset Class deleted successfully.',
        ]);
    }

}
