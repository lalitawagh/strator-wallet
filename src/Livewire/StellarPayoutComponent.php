<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Http\Helper;
use Kanexy\LedgerFoundation\Model\ExchangeRate;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\PartnerFoundation\Cxrm\Models\Contact;
use Livewire\Component;

class StellarPayoutComponent extends Component
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

    public $stellarCurrencies;


    public function mount($wallets, $beneficiaries, $countryWithFlags, $defaultCountry, $user, $ledgers, $asset_types, $workspace,$stellarCurrencies)
    {
       
        $this->wallets = $wallets;
        $this->beneficiaries = $beneficiaries;
        $this->countryWithFlags = $countryWithFlags;
        $this->defaultCountry = $defaultCountry;
        $this->user = $user;
        $this->ledgers = $ledgers;
        $this->stellarCurrencies = $stellarCurrencies;
        $this->asset_types = $asset_types;
        $this->workspace = $workspace;
        $this->balance = old('balance');
        $this->selected_wallet = old('wallet') ? old('wallet')  : $this->selected_wallet;
        $this->selected_currency = old('receiver_currency') ? old('receiver_currency'): $this->selected_currency;
        $this->phone = $beneficiaries->first()?->mobile;
        $this->country_code =  $beneficiaries->first()?->meta['country_code'] ?? '231';
        $this->self_beneficiary = Auth::user();
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
    }

    public function changeAmount($value)
    {
        $this->amount = $value;
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
        $exchange_wallet = $this->selected_currency;

        if(!is_null($this->selected_currency))
        {
            $this->amount =  !is_null($this->amount) ?  $this->amount : 1;
            $this->base_currency = $sender_wallet?->ledger?->name;
            $this->exchange_currency = $this->selected_currency;
            $this->fee = 0;
    
            $info = [
                'type' => 0,
                'amount' => 1,
                'currency' => $this->base_currency,
                'conversionCurrency' =>  $this->exchange_currency,
            ];
           
            
         
            $details = Helper::getStellarExchangeRate($info);
    
            $exchangedAmount = $details['exchangedAmount'];
            $this->exchange_rate =  @$exchangedAmount ?? 1;
            
           
            session([
                'payout_fee' => $this->fee,
                'payout_exchange_rate' => $this->exchange_rate,
                'payout_exchange_currency' => $this->base_currency,
                'payout_base_currency' => $this->exchange_currency,
                'payout_wallet' => $this->selected_wallet,
                'payout_currency' => $value
            ]);
        }

       
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
        $exchange_wallet = $value;

        if(!is_null($this->selected_wallet))
        {
            $this->amount =  !is_null($this->amount) ?  $this->amount : 1;
            $this->base_currency = $sender_wallet?->ledger?->name;
            $this->exchange_currency = $this->selected_currency;
            $this->fee = 0;
            
            $info = [
                'type' => 0,
                'amount' => 1,
                'currency' => $this->base_currency,
                'conversionCurrency' =>  $this->exchange_currency,
            ];
            
            
        
            $details = Helper::getStellarExchangeRate($info);
        
            $exchangedAmount = $details['exchangedAmount'];
            $this->exchange_rate =  @$exchangedAmount ?? 1;

            session([
                'payout_fee' => $this->fee,
                'payout_exchange_rate' => $this->exchange_rate,
                'payout_exchange_currency' => $this->base_currency,
                'payout_base_currency' => $this->exchange_currency,
                'payout_wallet' => $this->selected_wallet,
                'payout_currency' => $value
            ]);
        }
    }

    public function render()
    {
        $this->remaining_amount =  number_format((float)0, 2, '.', '');;

        if (is_numeric($this->amount)) {
            $remaining_amount = $this->balance - $this->amount;
            $this->remaining_amount =  number_format((float)$remaining_amount, 2, '.', '');
        }

        return view('ledger-foundation::Livewire.stellar-payout-component');
    }

}
