<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Entities\AssetType;
use Kanexy\LedgerFoundation\Entities\ExchangeRate;
use Kanexy\LedgerFoundation\Entities\Ledger;
use Kanexy\LedgerFoundation\Http\Requests\StoreExchangeRateRequest;

class ExchangeRateController extends Controller
{
    public function index()
    {
        $exchange_rates = ExchangeRate::with('assetType','ledger')->paginate();

        return view("ledger-foundation::exchange-rate.index", compact('exchange_rates'));
    }

    public function create()
    {
        $asset_types = AssetType::get();
        $ledgers = Ledger::get();

        return view("ledger-foundation::exchange-rate.create", compact('asset_types','ledgers'));
    }

    public function store(StoreExchangeRateRequest $request)
    {
        $data = $request->validated();
        $data['is_hard_stop'] = $request->has('is_hard_stop') ? '1' : '0';

        if(Ledger::whereId($data['base_currency'])->first()->asset_category != 'virtual' && AssetType::whereId($data['exchange_currency'])->first()->asset_category != 'virtual')
        {
            return back()->withError('Select at least one virtual currency');
        }

        ExchangeRate::create($data);

        return redirect()->route("dashboard.ledger-foundation.exchange-rate.index")->with([
            'status' => 'success',
            'message' => 'Exchange rate created successfully.'
        ]);
    }

    public function edit($id)
    {
        $asset_types = AssetType::get();
        $ledgers = Ledger::get();
        $exchange_rate = ExchangeRate::findOrFail($id);

        return view("ledger-foundation::exchange-rate.edit", compact('exchange_rate','asset_types','ledgers'));
    }

    public function update(StoreExchangeRateRequest $request, $id)
    {
        $exchange_rate = ExchangeRate::findOrFail($id);
        $data = $request->validated();
        if(Ledger::whereId($data['base_currency'])->first()->asset_category != 'virtual' && AssetType::whereId($data['exchange_currency'])->first()->asset_category != 'virtual')
        {
            return back()->withError('Select at least one virtual currency');
        }

        $data['is_hard_stop'] = $request->has('is_hard_stop') ? '1' : '0';


        $exchange_rate->update($data);

        return redirect()->route("dashboard.ledger-foundation.exchange-rate.index")->with([
            'status' => 'success',
            'message' => 'Ledger updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $exchange_rate = ExchangeRate::findOrFail($id);
        $exchange_rate->delete();

        return redirect()->route("dashboard.ledger-foundation.exchange-rate.index")->with([
            'status' => 'success',
            'message' => 'Exchange rate deleted successfully.'
        ]);
    }
}
