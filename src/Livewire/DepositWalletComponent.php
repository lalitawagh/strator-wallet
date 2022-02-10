<?php

namespace Kanexy\LedgerFoundation\Livewire;

use AmrShawky\LaravelCurrency\Facade\Currency;
use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Model\ExchangeRate;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Livewire\Component;

class DepositWalletComponent extends Component
{
    public $selected_wallet;

    public $currency;

    public $wallets;

    public $currencies;

    public $base_currency;

    public $exchange_currency;

    public $exchange_rate;

    public $fee;

    public $exchange_asset_category;

    public function mount($wallets,$currencies)
    {
        $this->wallets = $wallets;
        $this->currencies = $currencies;
        $this->selected_wallet = session('wallet');
        $this->currency = session('currency');
        if(!is_null(session('currency')))
        {
            $asset_type = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $this->currency);
            $this->exchange_asset_category = @$asset_type['asset_category'];
        }
    }

    public function changeBaseCurrency($base_currency)
    {
        $this->selected_wallet = $base_currency;
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
    }

    public function changeCurrency($value)
    {
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
        $wallet = Wallet::whereId($this->selected_wallet)->first();
        $ledger = Ledger::whereId($wallet?->ledger_id)->first();
        $asset_type = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $value);
        $this->exchange_asset_category = @$asset_type['asset_category'];
        $base_asset_category = $ledger?->asset_category;
        $exchange_asset_category = @$asset_type['asset_category'];

        if(@$base_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY &&  @$exchange_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY)
        {
            $base_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $value);
            $exchange_currency =  collect(Setting::getValue('asset_types',[]))->firstWhere('id', $ledger?->asset_type);

            $this->base_currency = @$base_currency['name'];
            $this->exchange_currency = @$exchange_currency['name'];
            if(!is_null($this->base_currency) && !is_null($this->exchange_currency))
            {
                $this->exchange_rate = Currency::convert()->from($this->base_currency)->to($this->exchange_currency)->get();
            }
            $this->fee = $ledger?->deposit_fee;
        }else{

            $exchange_rate_details = ExchangeRate::where(['base_currency' => $wallet?->ledger_id,'exchange_currency' => $value])->first();
            $base_currency =  collect(Setting::getValue('asset_types',[]))->firstWhere('id', $value);
            $exchange_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $ledger?->asset_type);

            $this->base_currency = @$base_currency['name'];
            $this->exchange_currency = @$exchange_currency['name'];
            $this->exchange_rate =  $exchange_rate_details?->exchange_rate;
            $this->fee = $exchange_rate_details?->exchange_fee;
        }

        session(['fee' => $this->fee,'exchange_rate' => $this->exchange_rate,'exchange_currency' => $this->exchange_currency,'base_currency' => $this->base_currency,'wallet' => $this->selected_wallet,'currency' => $value ,'base_asset_category' => $base_asset_category, 'exchange_asset_category' => $exchange_asset_category]);
    }


    public function render()
    {
       return view('ledger-foundation::Livewire.deposit-wallet-component');
    }
}
