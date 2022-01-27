<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Http\Requests\StoreAssetTypeRequest;

class AssetTypeController extends Controller
{
    public function index()
    {
        $asset_type_lists = Setting::getValue('asset_types',[]);

        return view("ledger-foundation::asset-type.index", compact('asset_type_lists'));
    }

    public function create()
    {
        return view("ledger-foundation::asset-type.create");
    }

    public function store(StoreAssetTypeRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('walletImages', 'azure') : 'demo.jpg';
        $data['status'] = $request->has('status') ? 'active' : 'inactive';
        $data['id'] = now()->format('dmYHis');

        $settings = collect(Setting::getValue('asset_types',[]))->push($data);

        Setting::updateOrCreate(['key' => 'asset_types'], ['value' => $settings]);

        return redirect()->route("dashboard.ledger-foundation.asset-type.index")->with([
            'status' => 'success',
            'message' => 'Asset Type created successfully.'
        ]);
    }

    public function edit($id)
    {
        $asset_type = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $id);
        return view("ledger-foundation::asset-type.edit", compact('asset_type'));
    }

    public function update(StoreAssetTypeRequest $request,$id)
    {
        $data = $request->validated();
        $data['id'] = $id;

        if($request->hasFile('image'))
        {
            $data['image'] = $request->file('image')->store('walletImages', 'azure');
        }
        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        $settings = collect(Setting::getValue('asset_types'))->filter(function ($item) use ($id) {
            if ($item['id'] != $id) {
                return $item;
            }
        });

        $settings->push($data);

        Setting::updateOrCreate(['key' => 'asset_types'], ['value' => $settings]);


        return redirect()->route("dashboard.ledger-foundation.asset-type.index")->with([
            'status' => 'success',
            'message' => 'Asset Type updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $settings = collect(Setting::getValue('asset_types', []))->filter(function ($item) use ($id) {
            if ($item['id'] != $id) {
                return $item;
            }
        });

        Setting::updateOrCreate(['key' => 'asset_types'], ['value' => $settings]);

        return redirect()->route("dashboard.ledger-foundation.asset-type.index")->with([
            'status' => 'success',
            'message' => 'Asset Type deleted successfully.'
        ]);
    }
}
