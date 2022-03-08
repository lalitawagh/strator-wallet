<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Http\Requests\StoreLedgerRequest;
use Kanexy\LedgerFoundation\Jobs\RegisterWalletsForLedger;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Policies\LedgerPolicy;

class LedgerController extends Controller
{
    public function index()
    {
        $this->authorize(LedgerPolicy::VIEW, Ledger::class);

        $ledgers = Ledger::paginate(7);

        return view("ledger-foundation::ledger.index", compact('ledgers'));
    }

    public function create()
    {
        $this->authorize(LedgerPolicy::CREATE, Ledger::class);

        $asset_types = Setting::getValue('asset_types',[]);
        $asset_classes = Setting::getValue('asset_classes',[]);
        $commodity_types = Setting::getValue('commodity_types',[]);

        return view("ledger-foundation::ledger.create", compact('asset_types','asset_classes','commodity_types'));
    }

    public function store(StoreLedgerRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('image'))
        {
            $data['image'] = $request->file('image')->store('walletImages', 'azure');
        }

        $ledger = Ledger::create($data);

        RegisterWalletsForLedger::dispatch($ledger);

        return redirect()->route("dashboard.wallet.ledger.index")->with([
            'status' => 'success',
            'message' => 'Ledger created successfully.',
        ]);
    }

    public function edit($id)
    {
        $this->authorize(LedgerPolicy::EDIT, Ledger::class);

        $ledger = Ledger::findOrFail($id);
        $asset_types = Setting::getValue('asset_types',[]);
        $asset_classes = Setting::getValue('asset_classes',[]);
        $commodity_types = Setting::getValue('commodity_types',[]);

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

        RegisterWalletsForLedger::dispatch($ledger);

        return redirect()->route("dashboard.wallet.ledger.index")->with([
            'status' => 'success',
            'message' => 'Ledger updated successfully.',
        ]);
    }

    public function destroy($id)
    {
        $this->authorize(LedgerPolicy::DELETE, Ledger::class);

        $ledger = Ledger::findOrFail($id);
        $ledger->delete();

        return redirect()->route("dashboard.wallet.ledger.index")->with([
            'status' => 'success',
            'message' => 'Ledger deleted successfully.',
        ]);
    }
}
