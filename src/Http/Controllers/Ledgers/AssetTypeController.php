<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Entities\AssetType;
use Kanexy\LedgerFoundation\Http\Requests\StoreAssetTypeRequest;

class AssetTypeController extends Controller
{
    public function index()
    {
        $asset_type_lists = AssetType::get();
        return view("ledger-foundation::asset-type.index", compact('asset_type_lists'));
    }

    public function create()
    {
        return view("ledger-foundation::asset-type.create");
    }

    public function store(StoreAssetTypeRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('documentImages', 's3') : 'demo.jpg';
        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        AssetType::create($data);

        return redirect()->route("dashboard.ledger-foundation.asset-type.index")->with([
            'status' => 'success',
            'message' => 'Asset Type created successfully.'
        ]);
    }

    public function edit($id)
    {
        $asset_type = AssetType::findOrFail($id);
        return view("ledger-foundation::asset-type.edit", compact('asset_type'));
    }

    public function update(StoreAssetTypeRequest $request,$id)
    {
        $asset_type = AssetType::findOrFail($id);
        $data = $request->validated();
        if($request->hasFile('image'))
        {
            $data['image'] = $request->file('image')->store('documentImages', 's3');
        }
        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        $asset_type->update($data);

        return redirect()->route("dashboard.ledger-foundation.asset-type.index")->with([
            'status' => 'success',
            'message' => 'Asset Type updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $asset_type = AssetType::findOrFail($id);
        $asset_type->delete();

        return redirect()->route("dashboard.ledger-foundation.asset-type.index")->with([
            'status' => 'success',
            'message' => 'Asset Type deleted successfully.'
        ]);
    }
}
