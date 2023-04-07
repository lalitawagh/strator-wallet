<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Model\ExchangeRate;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\PartnerFoundation\Cxrm\Models\Contact;
use Livewire\Component;

class WalletPayoutComponent extends Component
{
    public $wallets;

    public $beneficiaries;

    public $countryWithFlags;

    public $workspace;

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

    public $phone;

    public $country_code;

    public $type;

    public $self_beneficiary;

    public function mount($wallets, $beneficiaries, $countryWithFlags, $defaultCountry, $user, $ledgers, $asset_types, $workspace, $type)
    {
        $this->wallets = $wallets;
        $this->beneficiaries = $beneficiaries;
        $this->countryWithFlags = $countryWithFlags;
        $this->defaultCountry = $defaultCountry;
        $this->user = $user;
        $this->ledgers = $ledgers;
        $this->asset_types = $asset_types;
        $this->workspace = $workspace;
        $this->type = $type;
        $this->balance = old('balance');
        $this->selected_wallet = old('wallet') ?? '';
        $this->selected_currency = old('receiver_currency') ?? '';
        $this->phone = $beneficiaries->first()?->mobile;
        $this->country_code =  $beneficiaries->first()?->meta['country_code'] ?? '231';
        $this->self_beneficiary = Contact::whereMobile(Auth::user()->phone)->where('ref_type','wallet')->beneficiaries()->first();

        $this->dispatchBrowserEvent('UpdateLivewireSelect');
    }

    public function changeAmount($value)
    {
        $this->amount = $value;
        $sender_wallet = Wallet::whereId($this->selected_wallet)->first();
        $receiver_wallet = Wallet::whereId($this->selected_currency)->first();
        $exchangeFee = collect(Setting::getValue('wallet_fees', []))->where('base_currency', $sender_wallet?->ledger_id)->where('exchange_currency', $receiver_wallet?->ledger_id)->where('payment_type', 'payout')->first();
        $this->fee = 0;

        if (isset($exchangeFee) && !empty($this->amount)) {
            $this->fee = ($exchangeFee['fee_type'] == 'percentage') ? $this->amount * ($exchangeFee['percentage'] / 100) : $exchangeFee['amount'];
        }

        session(['payout_fee' => $this->fee]);
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
    }


    public function getWalletBalance($value)
    {
        $wallet = Wallet::find($value);
        $this->selected_wallet = $value;
        $this->balance = $wallet?->balance;
        $this->amount  = $this->amount;
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
        $this->selected_wallet = $value;
        $sender_wallet = Wallet::whereId($value)->first();
        $exchange_wallet = Wallet::whereId($this->selected_currency)->first();

        $walletDefaultCountry = Country::find(Setting::getValue('wallet_default_country'));

        $exchange_rate_details = ExchangeRate::getExchangeRateDetailsForPayout($sender_wallet, $exchange_wallet, $walletDefaultCountry, $this->amount);

        $this->base_currency = @$exchange_rate_details['base_currency_name'];
        $this->exchange_currency = @$exchange_rate_details['exchange_currency_name'];
        $this->exchange_rate =  @$exchange_rate_details['exchange_rate'] ?? 1;
        $this->fee = @$exchange_rate_details['fee'];
       
        session([
            'payout_fee' => $this->fee,
            'payout_exchange_rate' => $this->exchange_rate,
            'payout_exchange_currency' => $this->base_currency,
            'payout_base_currency' => $this->exchange_currency,
            'payout_wallet' => $this->selected_wallet,
            'payout_currency' => $value
        ]);
    }


    public function changeBeneficiary($value)
    {
        $beneficiary = Contact::find($value);
        $this->phone = $beneficiary?->mobile;
        $this->country_code = $beneficiary?->meta['country_code'] ?? '231';
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
    }

    public function changeCurrency($value)
    {
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
        $this->selected_currency = $value;
        $sender_wallet = Wallet::whereId($this->selected_wallet)->first();
        $exchange_wallet = Wallet::whereId($value)->first();

        $walletDefaultCountry = Country::find(Setting::getValue('wallet_default_country'));

        $exchange_rate_details = ExchangeRate::getExchangeRateDetailsForPayout($sender_wallet, $exchange_wallet, $walletDefaultCountry, $this->amount);

        $this->base_currency = @$exchange_rate_details['base_currency_name'];
        $this->exchange_currency = @$exchange_rate_details['exchange_currency_name'];
        $this->exchange_rate =  @$exchange_rate_details['exchange_rate'] ?? 1;
        $this->fee = @$exchange_rate_details['fee'];
        
        session([
            'payout_fee' => $this->fee,
            'payout_exchange_rate' => $this->exchange_rate,
            'payout_exchange_currency' => $this->base_currency,
            'payout_base_currency' => $this->exchange_currency,
            'payout_wallet' => $this->selected_wallet,
            'payout_currency' => $value
        ]);
    }

    public function render()
    {
        $this->remaining_amount =  number_format((float)0, 2, '.', '');;

        if (is_numeric($this->amount)) {
            $remaining_amount = $this->balance - $this->amount;
            $this->remaining_amount =  number_format((float)$remaining_amount, 2, '.', '');
        }

        return view('ledger-foundation::Livewire.wallet-payout-component');
    }
}
