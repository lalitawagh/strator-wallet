<?php

namespace Kanexy\LedgerFoundation\Livewire;

use AmrShawky\LaravelCurrency\Facade\Currency;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Model\ExchangeRate;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Livewire\Component;

class WalletPayoutComponent extends Component
{
    public $wallets;

    public $beneficiaries;

    public $countryWithFlags;

    public $defaultCountry;

    public $user;

    public $selected_wallet;

    public $balance;

    public $amount;

    public $remaining_amount;

    public $ledgers;

    public $base_currency;

    public $exchange_currency;

    public $fee;

    public $exchange_rate;

    public $asset_types;

    public $selected_currency;

    public function mount($wallets,$beneficiaries,$countryWithFlags,$defaultCountry,$user,$ledgers,$asset_types)
    {
        $this->wallets = $wallets;
        $this->beneficiaries = $beneficiaries;
        $this->countryWithFlags = $countryWithFlags;
        $this->defaultCountry = $defaultCountry;
        $this->user = $user;
        $this->ledgers = $ledgers;
        $this->asset_types = $asset_types;
        $this->balance = old('balance');
        $this->amount = old('amount');
        $this->selected_wallet = old('wallet');
        $this->selected_currency = old('receiver_currency');
    }

    public function getWalletBalance($value)
    {
        $wallet = Wallet::find($value);
        $this->selected_wallet = $value;
        $this->balance = $wallet?->balance;
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
    }

    public function changeCurrency($value)
    {
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
        $this->selected_currency = $value;
        $sender_wallet = Wallet::whereId($this->selected_wallet)->first();
        $exchange_wallet = Ledger::whereId($sender_wallet?->ledger_id)->first();
        $asset_type = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $value);
        $this->exchange_asset_category = @$asset_type['asset_category'];

        $exchange_rate_details = ExchangeRate::getExchangeRateDetailsForPayout($sender_wallet,$exchange_wallet,$value);

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
            'currency' => $value
        ]);
    }

    public function render()
    {
        $this->remaining_amount =  number_format((float)0, 2, '.', '');;

        if($this->amount)
        {
            $remaining_amount = $this->balance - $this->amount;
            $this->remaining_amount =  number_format((float)$remaining_amount, 2, '.', '');
        }

        return view('ledger-foundation::Livewire.wallet-payout-component');
    }
}
