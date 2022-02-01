<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Http\Requests\StoreExchangeRateRequest;
use Kanexy\LedgerFoundation\Model\ExchangeRate;
use Kanexy\LedgerFoundation\Model\Ledger;

class ExchangeRateController extends Controller
{
    public function index()
    {
        $exchange_rates = ExchangeRate::with('ledger')->paginate();

        return view("ledger-foundation::exchange-rate.index", compact('exchange_rates'));
    }

    public function create()
    {
        $ledgers = Ledger::get();
        $asset_types = Setting::getValue('asset_types',[]);

        return view("ledger-foundation::exchange-rate.create", compact('asset_types','ledgers'));
    }

    public function store(StoreExchangeRateRequest $request)
    {
        $data = $request->validated();
        $data['is_hard_stop'] = $request->has('is_hard_stop') ? '1' : '0';

        $asset_type = Setting::getValue('asset_types',[])->firstWhere('id', $data['exchange_currency']);

        if(Ledger::whereId($data['base_currency'])->first()->asset_category != 'VIRTUAL' &&  $asset_type['asset_category'] != 'virtual')
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
        $asset_types = Setting::getValue('asset_types',[]);
        $ledgers = Ledger::get();
        $exchange_rate = ExchangeRate::findOrFail($id);

        return view("ledger-foundation::exchange-rate.edit", compact('exchange_rate','asset_types','ledgers'));
    }

    public function update(StoreExchangeRateRequest $request, $id)
    {
        $exchange_rate = ExchangeRate::findOrFail($id);
        $data = $request->validated();

        $asset_type = Setting::getValue('asset_types',[])->firstWhere('id', $data['exchange_currency']);

        if(Ledger::whereId($data['base_currency'])->first()->asset_category != 'virtual' && $asset_type['asset_category'] != 'virtual')
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
