<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Livewire\Component;

class WalletTransactionDetailComponent extends Component
{
    public Transaction $transaction;

    public string $transactionType;

    protected $listeners = [
        'showTransactionDetail',
    ];

    public function showTransactionDetail(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->transactionType = (! isset($transaction->meta['card_id'])) ? 'Bank' : 'Card';
    }

    public function render()
    {
       return view('ledger-foundation::Livewire.wallet-transaction-detail-component');
    }
}
