<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Ledgers;

use Illuminate\Http\Request;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Contracts\Fee;
use Kanexy\LedgerFoundation\Http\Helper;
use Kanexy\LedgerFoundation\Http\Requests\StoreFeeRequest;
use Kanexy\LedgerFoundation\Model\ExchangeRate;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Policies\FeePolicy;

class FeeController extends Controller
{
    public function index()
    {
        $this->authorize(FeePolicy::VIEW, Fee::class);

        $fees = Helper::paginate(collect(Setting::getValue('wallet_fees', []))->reverse());

        return view("ledger-foundation::fees.index", compact('fees'));
    }

    public function create()
    {
        $this->authorize(FeePolicy::CREATE, Fee::class);

        $ledgers = Ledger::get();

        return view("ledger-foundation::fees.create", compact('ledgers'));
    }

    public function store(StoreFeeRequest $request)
    {
        $data = $request->validated();
        $sender_wallet = $data['base_currency'];
        $receiver_wallet = $data['exchange_currency'];
        $existFee = collect(Setting::getValue('wallet_fees', []))->where('base_currency', $sender_wallet)->where('exchange_currency', $receiver_wallet)->where('payment_type', $data['payment_type'])->first();

        if (!is_null($existFee)) {
            return back()->withError('Exchange Already Exists');
        }

        $data['id'] = now()->format('dmYHis');
        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        $settings = collect(Setting::getValue('wallet_fees', []))->push($data);

        Setting::updateOrCreate(['key' => 'wallet_fees'], ['value' => $settings]);

        return redirect()->route('dashboard.wallet.fee.index')->with([
            'status' => 'success',
            'message' => 'Fee created successfully.',
        ]);
    }

    public function edit($id)
    {
        $this->authorize(FeePolicy::EDIT, Fee::class);

        $fee = collect(Setting::getValue('wallet_fees', []))->firstWhere('id', $id);
        $ledgers = Ledger::get();

        return view("ledger-foundation::fees.edit", compact('fee', 'ledgers'));
    }

    public function update(StoreFeeRequest $request, $id)
    {

        $data = $request->validated();
        $data['id'] = $id;
        $data['amount'] = ($data['fee_type'] == 'amount') ? $data['amount'] : 0;
        $data['percentage'] = ($data['fee_type'] == 'percentage') ? $data['percentage'] : 0;
        $data['status'] = $request->has('status') ? 'active' : 'inactive';


        $base_asset_category = Ledger::whereId($data['base_currency'])->first()->asset_category;
        $exchange_asset_category = Ledger::whereId($data['exchange_currency'])->first()->asset_category;

        if (is_null($base_asset_category)) {
            return back()->withError('Base currency not exists');
        }

        if (is_null($exchange_asset_category)) {
            return back()->withError('Exchange currency not exists');
        }

        $existExchangeRate = ExchangeRate::where(['base_currency' => $data['base_currency'], 'exchange_currency' => $data['exchange_currency']])->first();


        //  if(!is_null($item))
        // {
        //     return back()->withError('Exchange Already Exists');
        //    }


        if (!is_null($existExchangeRate) && ($id != $existExchangeRate->id)) {
            return back()->withError('This exchange rate already exist');
        }

        $settings = collect(Setting::getValue('wallet_fees'))->map(function ($item) use ($id, $data) {
            if ($item['id'] == $id) {
                return $data;
            }

            return $item;
        });

        Setting::updateOrCreate(['key' => 'wallet_fees'], ['value' => $settings]);


        return redirect()->route("dashboard.wallet.fee.index")->with([
            'status' => 'success',
            'message' => 'Fee updated successfully.',
        ]);
    }


    public function destroy($id, Request $request)
    {
        $this->authorize(FeePolicy::DELETE, Fee::class);

        $settings = collect(Setting::getValue('wallet_fees', []))->filter(function ($item) use ($id) {
            if ($item['id'] != $id) {
                return true;
            }
            return false;
        });

        Setting::updateOrCreate(['key' => 'wallet_fees'], ['value' => $settings]);

        $count = $request->count ?? 0;
        $url = $request->previousPage ?? route("dashboard.wallet.fee.index");
        $message = [
            'status' => 'success',
            'message' => 'Fee deleted successfully.',
        ];

        return Helper::redirectionOnDelete($count, $url, $message);
    }
}
