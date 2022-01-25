<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Entities\CommodityType;
use Kanexy\LedgerFoundation\Http\Requests\StoreCommodityRequest;

class CommodityTypeController extends Controller
{
    public function index()
    {
        $commodity_type_lists = CommodityType::get();
        return view("ledger-foundation::commodity-type.index", compact('commodity_type_lists'));
    }

    public function create()
    {
        return view("ledger-foundation::commodity-type.create");
    }

    public function store(StoreCommodityRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('walletImages', 'azure') : 'demo.jpg';
        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        CommodityType::create($data);

        return redirect()->route("dashboard.ledger-foundation.commodity-type.index")->with([
            'status' => 'success',
            'message' => 'Commodity Type created successfully.'
        ]);
    }

    public function edit($id)
    {
        $commodity_type = CommodityType::findOrFail($id);
        return view("ledger-foundation::commodity-type.edit", compact('commodity_type'));
    }

    public function update(StoreCommodityRequest $request,$id)
    {
        $commodity_type = CommodityType::findOrFail($id);
        $data = $request->validated();
        if($request->hasFile('image'))
        {
            $data['image'] = $request->file('image')->store('walletImages', 'azure');
        }
        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        $commodity_type->update($data);

        return redirect()->route("dashboard.ledger-foundation.commodity-type.index")->with([
            'status' => 'success',
            'message' => 'Commodity Type updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $commodity_type = CommodityType::findOrFail($id);
        $commodity_type->delete();

        return redirect()->route("dashboard.ledger-foundation.commodity-type.index")->with([
            'status' => 'success',
            'message' => 'Commodity Type deleted successfully.'
        ]);
    }
}
