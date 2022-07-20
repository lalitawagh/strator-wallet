<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Illuminate\Http\Request;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Contracts\CommodityTypeConfiguration;
use Kanexy\LedgerFoundation\Http\Helper;
use Kanexy\LedgerFoundation\Http\Requests\StoreCommodityRequest;
use Kanexy\LedgerFoundation\Policies\CommodityTypePolicy;

class CommodityTypeController extends Controller
{
    public function index()
    {
        $this->authorize(CommodityTypePolicy::VIEW, CommodityTypeConfiguration::class);

        $commodity_type_lists = Helper::paginate(collect(Setting::getValue('commodity_types', []))->reverse());

        return view("ledger-foundation::commodity-type.index", compact('commodity_type_lists'));
    }

    public function create()
    {
        $this->authorize(CommodityTypePolicy::CREATE, CommodityTypeConfiguration::class);

        return view("ledger-foundation::commodity-type.create");
    }

    public function store(StoreCommodityRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('walletImages', 'azure');
        }
        $data['status'] = $request->has('status') ? 'active' : 'inactive';
        $data['id'] = now()->format('dmYHis');

        $settings = collect(Setting::getValue('commodity_types', []))->push($data);

        Setting::updateOrCreate(['key' => 'commodity_types'], ['value' => $settings]);

        return redirect()->route("dashboard.wallet.commodity-type.index")->with([
            'status' => 'success',
            'message' => 'Commodity Type created successfully.',
        ]);
    }

    public function edit($id)
    {
        $this->authorize(CommodityTypePolicy::EDIT, CommodityTypeConfiguration::class);

        $commodity_type = collect(Setting::getValue('commodity_types', []))->firstWhere('id', $id);

        return view("ledger-foundation::commodity-type.edit", compact('commodity_type'));
    }

    public function update(StoreCommodityRequest $request, $id)
    {
        $data = $request->validated();
        $data['id'] = $id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('walletImages', 'azure');
        }

        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        $settings = collect(Setting::getValue('commodity_types'))->map(function ($item) use ($id, $data) {
            if ($item['id'] == $id) {
                $data['image'] = $data['image'] ?? @$item['image'];
                return $data;
            }

            return $item;
        });

        Setting::updateOrCreate(['key' => 'commodity_types'], ['value' => $settings]);

        return redirect()->route("dashboard.wallet.commodity-type.index")->with([
            'status' => 'success',
            'message' => 'Commodity Type updated successfully.',
        ]);
    }

    public function destroy($id, Request $request)
    {
        $this->authorize(CommodityTypePolicy::DELETE, CommodityTypeConfiguration::class);

        $settings = collect(Setting::getValue('commodity_types', []))->filter(function ($item) use ($id) {
            if ($item['id'] != $id) {
                return true;
            }
            return false;
        });

        Setting::updateOrCreate(['key' => 'commodity_types'], ['value' => $settings]);

        $count = $request->count ?? 0;
        $url = $request->previousPage ?? route("dashboard.wallet.commodity-type.index");
        $message = [
            'status' => 'success',
            'message' => 'Commodity Type deleted successfully.',
        ];

        return Helper::redirectionOnDelete($count, $url, $message);
    }
}
