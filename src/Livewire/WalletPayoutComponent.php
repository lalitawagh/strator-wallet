<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Kanexy\LedgerFoundation\Model\Wallet;
use Livewire\Component;

class WalletPayoutComponent extends Component
{
    public $wallets;

    public $beneficiaries;

    public $countryWithFlags;

    public $defaultCountry;

    public $user;

    public $wallet;

    public $balance;

    public $amount;

    public $remaining_amount;

    public function mount($wallets,$beneficiaries,$countryWithFlags,$defaultCountry,$user)
    {
        $this->wallets = $wallets;
        $this->beneficiaries = $beneficiaries;
        $this->countryWithFlags = $countryWithFlags;
        $this->defaultCountry = $defaultCountry;
        $this->user = $user;
        $this->balance = old('balance');
        $this->amount = old('amount');
    }

    public function getWalletBalance($value)
    {
        $wallet = Wallet::find($value);
        $this->wallet = $value;
        $this->balance = $wallet?->balance;
    }

    public function render()
    {
        $this->remaining_amount = 0;

        if($this->amount)
        {
            $this->remaining_amount = $this->balance - $this->amount;
        }

        return view('ledger-foundation::Livewire.wallet-payout-component');
    }
}
