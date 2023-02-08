<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Kanexy\LedgerFoundation\Http\Helper;
use Livewire\Component;

class StellarExchangeRateConvert extends Component
{
    public $from;

    public $to;

    public $sending_amount;

    public $receive_amount;

    // public function mount($countryWithFlags, $defaultCountry, $user, $workspace, $type)
    // {
    //     $this->countryWithFlags = $countryWithFlags;
    //     $this->defaultCountry = $defaultCountry;
    //     $this->user = $user;
    //     $this->workspace = $workspace;
    //     $this->mobile = $user->phone;
    //     $this->type = $type;
    // }

    public function render()
    {
        
        return view('ledger-foundation::Livewire.stellar-exchange-rate-convert');
    }

    public function getSenderCurrency($value)
    {
        $this->from = $value;
       
    }

    public function getReceiverCurrency($value)
    {
        $this->to = $value;
        $info = [
            'type' => 0,
            'amount' => $this->sending_amount,
            'currency' => $this->from,
            'conversionCurrency' => $this->to,
        ];
       

        $details = Helper::getStellarExchangeRate($info);
        $this->receive_amount = $details['exchangedAmount'];
    }
}