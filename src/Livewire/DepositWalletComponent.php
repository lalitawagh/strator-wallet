<?php

namespace Kanexy\LedgerFoundation\Livewire;

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

    public $walletDefaultCountry;

    public $user;

    public function mount($wallets, $currencies, $walletDefaultCountry)
    {
        $this->wallets = $wallets;
        $this->currencies = $currencies;
        $this->walletDefaultCountry = $walletDefaultCountry;
        $this->selected_wallet = session('wallet');
        $this->currency = session('currency');
        if (!is_null(session('currency'))) {
            $asset_type = collect(Setting::getValue('asset_types', []))->firstWhere('id', $this->currency);
            $this->exchange_asset_category = @$asset_type['asset_category'];
        }
        $this->user = Auth::user();
    }

    public function changeBaseCurrency($base_currency)
    {
        $this->selected_wallet = $base_currency;
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
    }

    public function changeCurrency($value)
    {
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
        $sender_wallet = Wallet::whereId($this->selected_wallet)->first();
        $exchange_wallet = Ledger::whereId($sender_wallet?->ledger_id)->first();
        $asset_type = collect(Setting::getValue('asset_types', []))->firstWhere('id', $value);
        $this->exchange_asset_category = @$asset_type['asset_category'];
        $base_asset_category = $exchange_wallet?->asset_category;
        $exchange_asset_category = @$asset_type['asset_category'];

        $exchange_rate_details = ExchangeRate::getExchangeRateDetailsForDeposit($sender_wallet, $exchange_wallet, $value);

        $this->base_currency = @$exchange_rate_details['base_currency_name'];
        $this->exchange_currency = @$exchange_rate_details['exchange_currency_name'];
        $this->exchange_rate =  @$exchange_rate_details['exchange_rate'];
        $this->fee = @$exchange_rate_details['fee'];

        session([
            'fee' => $this->fee,
            'exchange_rate' => $this->exchange_rate,
            'exchange_currency' => $this->exchange_currency,
            'base_currency' => $this->base_currency,
            'wallet' => $this->selected_wallet,
            'currency' => $value,
            'base_asset_category' => $base_asset_category,
            'exchange_asset_category' => $exchange_asset_category
        ]);
    }

    public function render()
    {
        return view('ledger-foundation::Livewire.deposit-wallet-component');
    }
}
