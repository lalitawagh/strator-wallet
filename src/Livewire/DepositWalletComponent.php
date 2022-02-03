<?php

namespace Kanexy\LedgerFoundation\Livewire;

use AmrShawky\LaravelCurrency\Facade\Currency;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Model\ExchangeRate;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Livewire\Component;

class DepositWalletComponent extends Component
{
    public $wallet;

    public $currency;

    public $wallets;

    public $currencies;

    public $base_currency;

    public $exchange_currency;

    public $exchange_rate;

    public $fee;

    public $amount;

    public function mount($wallets,$currencies)
    {
        $this->wallets = $wallets;
        $this->currencies = $currencies;
        $this->wallet = session('wallet');
        $this->currency = session('currency');
        $this->amount = session('amount');
    }

    public function changeBaseCurrency($base_currency)
    {
        $this->wallet = $base_currency;
        $this->dispatchBrowserEvent('UpdateLivewireSelect',['class' => 'walletLedgerEvent','options' => $this->wallets]);
    }

    public function changeCurrency($value)
    {
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
        $wallet = Wallet::whereId($this->wallet)->first();
        $ledger = Ledger::whereId($wallet?->ledger_id)->first();
        $asset_type = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $value);
        $base_asset_category = $ledger?->asset_category;
        $exchange_asset_category = $asset_type['asset_category'];

        if(@$base_asset_category != \Kanexy\LedgerFoundation\Enums\AssetCategory::VIRTUAL &&  @$exchange_asset_category != \Kanexy\LedgerFoundation\Enums\AssetCategory::VIRTUAL)
        {
            $base_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $ledger->asset_type);
            $exchange_currency =  collect(Setting::getValue('asset_types',[]))->firstWhere('id', $value);

            $this->base_currency = $base_currency['name'];
            $this->exchange_currency = $exchange_currency['name'];
            $this->exchange_rate = Currency::convert()->from($this->base_currency)->to($this->exchange_currency)->get();
            $this->fee = $ledger->deposit_fee;
        }else{
            $exchange_rate_details = ExchangeRate::where(['base_currency' => $wallet->ledger_id,'exchange_currency' => $value])->first();
            $base_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $ledger->asset_type);
            $exchange_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $value);

            $this->base_currency = ($ledger->asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::VIRTUAL) ? 'Coin' : $base_currency['name'];
            $this->exchange_currency = ($exchange_currency['asset_category'] == \Kanexy\LedgerFoundation\Enums\AssetCategory::VIRTUAL) ? 'Coin' : $exchange_currency['name'];
            $this->exchange_rate =  $exchange_rate_details?->exchange_rate;
            $this->fee = $exchange_rate_details?->exchange_fee;
        }

        session(['fee' => $this->fee,'exchange_rate' => $this->exchange_rate,'exchange_currency' => $this->exchange_currency,'base_currency' => $this->base_currency,'wallet' => $this->wallet,'currency' => $value,'amount' => $this->amount]);
    }

    public function render()
    {
       return view('ledger-foundation::Livewire.deposit-wallet-component');
    }
}
