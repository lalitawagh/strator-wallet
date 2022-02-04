<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Livewire\Component;

class WalletTransactionDetailComponent extends Component
{
    public Transaction $transaction;

    public Wallet $wallet;

    public string $transactionType;

    protected $listeners = [
        'showTransactionDetail',
    ];

    public function showTransactionDetail(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->wallet = Wallet::findOrFail($transaction->ref_id);
        $this->transactionType = 'Wallet';
    }

    public function render()
    {
       return view('ledger-foundation::Livewire.wallet-transaction-detail-component');
    }
}
