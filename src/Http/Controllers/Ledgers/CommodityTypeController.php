<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Http\Requests\StoreCommodityRequest;
use Kanexy\LedgerFoundation\Policies\CommodityTypePolicy;

class CommodityTypeController extends Controller
{
    public function index()
    {
        $this->authorize(CommodityTypePolicy::VIEW, Setting::class);

        $commodity_type_lists = Setting::getValue('commodity_types',[]);

        return view("ledger-foundation::commodity-type.index", compact('commodity_type_lists'));
    }

    public function create()
    {
        $this->authorize(CommodityTypePolicy::CREATE, Setting::class);

        return view("ledger-foundation::commodity-type.create");
    }

    public function store(StoreCommodityRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('walletImages', 'azure') : 'demo.jpg';
        $data['status'] = $request->has('status') ? 'active' : 'inactive';
        $data['id'] = now()->format('dmYHis');

        $settings = collect(Setting::getValue('commodity_types',[]))->push($data);

        Setting::updateOrCreate(['key' => 'commodity_types'], ['value' => $settings]);

        return redirect()->route("dashboard.ledger-foundation.commodity-type.index")->with([
            'status' => 'success',
            'message' => 'Commodity Type created successfully.',
        ]);
    }

    public function edit($id)
    {
        $this->authorize(CommodityTypePolicy::EDIT, Setting::class);

        $commodity_type = collect(Setting::getValue('commodity_types',[]))->firstWhere('id', $id);

        return view("ledger-foundation::commodity-type.edit", compact('commodity_type'));
    }

    public function update(StoreCommodityRequest $request,$id)
    {
        $data = $request->validated();
        $data['id'] = $id;

        $existing_image = '';
        $settings = collect(Setting::getValue('commodity_types'))->filter(function ($item) use ($id, &$existing_image) {
            if ($item['id'] != $id) {
                return true;
            }

            $existing_image = $item['image'] ?? 'demo.jpg';
            return false;
        });

        $data['image'] = $existing_image;
        if($request->hasFile('image'))
        {
            $data['image'] = $request->file('image')->store('walletImages', 'azure');
        }

        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        $settings->push($data);

        Setting::updateOrCreate(['key' => 'commodity_types'], ['value' => $settings]);

        return redirect()->route("dashboard.ledger-foundation.commodity-type.index")->with([
            'status' => 'success',
            'message' => 'Commodity Type updated successfully.',
        ]);
    }

    public function destroy($id)
    {
        $this->authorize(CommodityTypePolicy::DELETE, Setting::class);

        $settings = collect(Setting::getValue('commodity_types', []))->filter(function ($item) use ($id) {
            if ($item['id'] != $id) {
                return true;
            }
            return false;
        });

        Setting::updateOrCreate(['key' => 'commodity_types'], ['value' => $settings]);

        return redirect()->route("dashboard.ledger-foundation.commodity-type.index")->with([
            'status' => 'success',
            'message' => 'Commodity Type deleted successfully.',
        ]);
    }
}
