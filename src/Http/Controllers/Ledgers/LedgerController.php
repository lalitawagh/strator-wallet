<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Illuminate\Http\Request;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Entities\AssetClass;
use Kanexy\LedgerFoundation\Entities\AssetType;
use Kanexy\LedgerFoundation\Entities\CommodityType;
use Kanexy\LedgerFoundation\Entities\Ledger;
use Kanexy\LedgerFoundation\Http\Requests\StoreLedgerRequest;

class LedgerController extends Controller
{
    public function index()
    {
        $ledgers = Ledger::with('assetType','assetClass')->get();

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
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('walletImages', 'azure') : 'demo.jpg';

        Ledger::create($data);

        return redirect()->route("dashboard.ledger-foundation.ledger.index")->with([
            'status' => 'success',
            'message' => 'Ledger created successfully.'
        ]);
    }

    public function edit($id)
    {
        $ledger = Ledger::findOrFail($id);
        $asset_types = AssetType::get();
        $asset_classes = AssetClass::get();
        $commodity_types = CommodityType::get();
        return view("ledger-foundation::ledger.edit", compact('ledger','asset_types','asset_classes','commodity_types'));
    }

    public function update(StoreLedgerRequest $request, $id)
    {
        $ledger = Ledger::findOrFail($id);
        $data = $request->validated();
        if($request->hasFile('image'))
        {
            $data['image'] = $request->file('image')->store('walletImages', 'azure');
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
