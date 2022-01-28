<?php

namespace Kanexy\LedgerFoundation\Livewire;

use AmrShawky\LaravelCurrency\Facade\Currency;
use Kanexy\LedgerFoundation\Entities\AssetType;
use Kanexy\LedgerFoundation\Entities\ExchangeRate;
use Kanexy\LedgerFoundation\Entities\Ledger;
use Kanexy\LedgerFoundation\Entities\Wallet;
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

    public function changeCurrency($value)
    {

        $wallet = Wallet::whereId($this->wallet)->first();
        $ledger = Ledger::whereId($wallet->ledger_id)->first();

        if($ledger->asset_category != 'VIRTUAL' && AssetType::whereId($value)->first()->asset_category != 'virtual')
        {
            $this->base_currency = AssetType::whereId($ledger->asset_type)->first()->name;
            $this->exchange_currency = AssetType::whereId($value)->first()->name;
            $this->exchange_rate = Currency::convert()->from($this->base_currency)->to($this->exchange_currency)->get();
            $this->fee = $ledger->deposit_fee;
        }else{
            $exchange_rate_details = ExchangeRate::where(['base_currency' => $wallet->ledger_id,'exchange_currency' => $value])->first();
            $this->base_currency = ($ledger->asset_category == 'VIRTUAL') ? 'Coin' :AssetType::whereId($ledger->asset_type)->first()->name;
            $this->exchange_currency = (AssetType::whereId($value)->first()->asset_category == 'virtual') ? 'Coin' :AssetType::whereId($value)->first()->name;
            $this->exchange_rate =  $exchange_rate_details->exchange_rate;
            $this->fee = $exchange_rate_details->exchange_fee;
        }

        session(['fee' => $this->fee,'exchange_rate' => $this->exchange_rate,'exchange_currency' => $this->exchange_currency,'base_currency' => $this->base_currency,'wallet' => $this->wallet,'currency' => $value,'amount' => $this->amount]);
    }

    public function render()
    {
       return view('ledger-foundation::Livewire.deposit-wallet-component');
    }
}
