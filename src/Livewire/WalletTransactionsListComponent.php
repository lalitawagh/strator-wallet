<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Kanexy\Cms\Setting\Models\Setting;
use Livewire\Component;

class WalletTransactionsListComponent extends Component
{
    public $wallet_urn;

    protected $listeners = [
        'transactionList',
    ];

    public function transactionList($walletURN)
    {
        $this->wallet_urn = $walletURN;
    }

    public function render()
    {
       return view('ledger-foundation::Livewire.wallet-transactions-list-component');
    }
}
