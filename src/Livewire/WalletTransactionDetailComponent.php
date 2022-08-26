<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Livewire\Component;

class WalletTransactionDetailComponent extends Component
{
    public Transaction $transaction;

    public Wallet $wallet;

    protected $listeners = [
        'showTransactionDetail',
    ];

    public function showTransactionDetail(Transaction $transaction)
    {
        $this->transaction = $transaction;
        
        if(!is_null($transaction->ref_id) && $transaction->ref_type == 'wallet')
        {
            $this->wallet = Wallet::find($transaction->ref_id);
        }
    }

    public function render()
    {
        return view('ledger-foundation::Livewire.wallet-transaction-detail-component');
    }
}
