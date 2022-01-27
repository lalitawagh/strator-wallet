<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Illuminate\Routing\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Http\Requests\StoreAssetClassRequest;

class AssetClassController extends Controller
{
    public function index()
    {
        $asset_class_lists = Setting::getValue('asset_classes',[]);
        return view("ledger-foundation::asset-class.index", compact('asset_class_lists'));
    }

    public function create()
    {
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
            'message' => 'Asset Class created successfully.'
        ]);
    }

    public function edit($id)
    {
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
                return $item;
            }
        });

        $settings->push($data);

        Setting::updateOrCreate(['key' => 'asset_classes'], ['value' => $settings]);

        return redirect()->route("dashboard.ledger-foundation.asset-class.index")->with([
            'status' => 'success',
            'message' => 'Asset Class updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $settings = collect(Setting::getValue('asset_classes', []))->filter(function ($item) use ($id) {
            if ($item['id'] != $id) {
                return $item;
            }
        });

        Setting::updateOrCreate(['key' => 'asset_classes'], ['value' => $settings]);

        return redirect()->route("dashboard.ledger-foundation.asset-class.index")->with([
            'status' => 'success',
            'message' => 'Asset Class deleted successfully.'
        ]);
    }

}
