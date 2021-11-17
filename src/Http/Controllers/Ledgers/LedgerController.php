<?php

namespace Riteserve\LedgerFoundation\Http\Controllers\Ledgers;

use Illuminate\Http\Request;
use Riteserve\Cms\Controllers\Controller;
use Riteserve\LedgerFoundation\Entities\AssetClass;
use Riteserve\LedgerFoundation\Entities\AssetType;
use Riteserve\LedgerFoundation\Entities\CommodityType;
use Riteserve\LedgerFoundation\Entities\Ledger;
use Riteserve\LedgerFoundation\Http\Requests\StoreLedgerRequest;

class LedgerController extends Controller
{
    public function index()
    {
        $ledgers = Ledger::paginate();
        return view("ledger-foundation::ledger.index", compact('ledgers'));
    }

    public function create()
    {
        $asset_types = AssetType::get();
        $asset_classes = AssetClass::get();
        $commodity_types = CommodityType::get();
        return view("ledger-foundation::ledger.create", compact('asset_types','asset_classes','commodity_types'));
    }

    public function store(StoreLedgerRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('documentImages', 's3') : 'demo.jpg';

        Ledger::create($data);

        return redirect()->route("dashboard.ledger-foundation.ledger.index")->with([
            'status' => 'success',
            'message' => 'Ledger created successfully.'
        ]);
    }

    public function edit($id)
    {
        $ledger = Ledger::findOrFail($id);
        return view("ledger-foundation::ledger.edit", compact('ledger'));
    }

    public function update(StoreLedgerRequest $request, $id)
    {
        $ledger = Ledger::findOrFail($id);
        $data = $request->validated();
        if($request->hasFile('image'))
        {
            $data['image'] = $request->file('image')->store('documentImages', 's3');
        }

        $ledger->update($data);

        return redirect()->route("dashboard.ledger-foundation.ledger.index")->with([
            'status' => 'success',
            'message' => 'Ledger updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $ledger = Ledger::findOrFail($id);
        $ledger->delete();

        return redirect()->route("dashboard.ledger-foundation.ledger.index")->with([
            'status' => 'success',
            'message' => 'Ledger deleted successfully.'
        ]);
    }

    public function getAssetType(Request $request)
    {
        $asset_types = AssetType::whereAssetCategory($request->input('assetCategory'))->get();
        $html = '';

        foreach($asset_types as $asset_type)
        {
            $html .= '<option value="'.$asset_type->getKey().'">'.$asset_type->name.'</option>';
        }

        return $html;
    }
}
