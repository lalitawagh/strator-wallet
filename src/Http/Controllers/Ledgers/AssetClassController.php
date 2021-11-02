<?php

namespace Riteserve\LedgerFoundation\Http\Controllers\Ledgers;

use Illuminate\Routing\Controller;
use Riteserve\LedgerFoundation\Entities\AssetClass;
use Riteserve\LedgerFoundation\Http\Requests\StoreAssetClassRequest;

class AssetClassController extends Controller
{
    public function index()
    {
        $asset_class_lists = AssetClass::get();
        return view("ledger-foundation::asset-class.index", compact('asset_class_lists'));
    }

    public function create()
    {
        return view("ledger-foundation::asset-class.create");
    }

    public function store(StoreAssetClassRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('documentImages', 's3') : 'demo.jpg';
        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        AssetClass::create($data);

        return redirect()->route("dashboard.ledger-foundation.asset-class.index")->with([
            'status' => 'success',
            'message' => 'Asset Class created successfully.'
        ]);
    }

    public function edit($id)
    {
        $asset_class = AssetClass::findOrFail($id);
        return view("ledger-foundation::asset-class.edit", compact('asset_class'));
    }

    public function update(StoreAssetClassRequest $request,$id)
    {
        $asset_class = AssetClass::findOrFail($id);
        $data = $request->validated();
        if($request->hasFile('image'))
        {
            $data['image'] = $request->file('image')->store('documentImages', 's3');
        }
        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        $asset_class->update($data);

        return redirect()->route("dashboard.ledger-foundation.asset-class.index")->with([
            'status' => 'success',
            'message' => 'Asset Class updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $asset_class = AssetClass::findOrFail($id);
        $asset_class->delete();

        return redirect()->route("dashboard.ledger-foundation.asset-class.index")->with([
            'status' => 'success',
            'message' => 'Asset Class deleted successfully.'
        ]);
    }

}
