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

    public $selected_wallet;

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
        $this->selected_wallet = $value;
        $this->balance = $wallet?->balance;
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
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
