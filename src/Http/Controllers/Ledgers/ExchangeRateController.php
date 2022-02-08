<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Http\Requests\StoreExchangeRateRequest;
use Kanexy\LedgerFoundation\Model\ExchangeRate;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Policies\ExchangeRatePolicy;

class ExchangeRateController extends Controller
{
    public function index()
    {
        $this->authorize(ExchangeRatePolicy::VIEW, ExchangeRate::class);

        $exchange_rates = ExchangeRate::with('ledger')->paginate();

        return view("ledger-foundation::exchange-rate.index", compact('exchange_rates'));
    }

    public function create()
    {
        $this->authorize(ExchangeRatePolicy::CREATE, ExchangeRate::class);

        $ledgers = Ledger::get();
        $asset_types = Setting::getValue('asset_types',[]);

        return view("ledger-foundation::exchange-rate.create", compact('asset_types','ledgers'));
    }

    public function store(StoreExchangeRateRequest $request)
    {
        $data = $request->validated();
        $data['is_hard_stop'] = $request->has('is_hard_stop') ? '1' : '0';
        $data['valid_date'] = date('Y-m-d',strtotime($data['valid_date']));

        $asset_type = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $data['exchange_currency']);
        $base_asset_category = Ledger::whereId($data['base_currency'])->first()->asset_category;
        $exchange_asset_category = $asset_type['asset_category'];

        if(is_null($base_asset_category))
        {
            return back()->withError('Base currency not exists');
        }

        if(is_null($exchange_asset_category))
        {
            return back()->withError('Exchange currency not exists');
        }

        if($base_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY &&  $exchange_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY)
        {
            return back()->withError('Select at least one virtual currency');
        }

        ExchangeRate::create($data);

        return redirect()->route("dashboard.wallet.exchange-rate.index")->with([
            'status' => 'success',
            'message' => 'Exchange rate created successfully.',
        ]);
    }

    public function edit($id)
    {
        $this->authorize(ExchangeRatePolicy::EDIT, ExchangeRate::class);

        $asset_types = Setting::getValue('asset_types',[]);
        $ledgers = Ledger::get();
        $exchange_rate = ExchangeRate::findOrFail($id);

        return view("ledger-foundation::exchange-rate.edit", compact('exchange_rate','asset_types','ledgers'));
    }

    public function update(StoreExchangeRateRequest $request, $id)
    {
        $exchange_rate = ExchangeRate::findOrFail($id);
        $data = $request->validated();
        $data['valid_date'] = date('Y-m-d',strtotime($data['valid_date']));

        $asset_type = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $data['exchange_currency']);
        $base_asset_category = Ledger::whereId($data['base_currency'])->first()->asset_category;
        $exchange_asset_category = $asset_type['asset_category'];

        if(is_null($base_asset_category))
        {
            return back()->withError('Base currency not exists');
        }

        if(is_null($exchange_asset_category))
        {
            return back()->withError('Exchange currency not exists');
        }

        if($base_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY && $exchange_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY)
        {
            return back()->withError('Select at least one virtual currency');
        }

        $data['is_hard_stop'] = $request->has('is_hard_stop') ? '1' : '0';


        $exchange_rate->update($data);

        return redirect()->route("dashboard.wallet.exchange-rate.index")->with([
            'status' => 'success',
            'message' => 'Ledger updated successfully.',
        ]);
    }

    public function destroy($id)
    {
        $this->authorize(ExchangeRatePolicy::DELETE, ExchangeRate::class);

        $exchange_rate = ExchangeRate::findOrFail($id);
        $exchange_rate->delete();

        return redirect()->route("dashboard.wallet.exchange-rate.index")->with([
            'status' => 'success',
            'message' => 'Exchange rate deleted successfully.',
        ]);
    }
}
