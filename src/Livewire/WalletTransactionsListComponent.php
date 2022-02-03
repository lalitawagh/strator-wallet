<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Livewire\Component;

class WalletTransactionsListComponent extends Component
{
    public $wallet_id, $wallet_name;

    public $transactions = [];

    public Transaction $transaction;

    public string $transactionType;

    protected $listeners = [
        'transactionList',
        'showTransactionDetail',
    ];

    public function transactionList($walletID, $walletName)
    {
        $this->wallet_name = $walletName;
        $transactions = Transaction::where("ref_id", $walletID)->latest()->take(15)->get();
        if(!empty($transactions)){
            $this->transactions = $transactions;
        }
    }

    public function showTransactionDetail(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->transactionType = (! isset($transaction->meta['card_id'])) ? 'Bank' : 'Card';
    }

    public function render()
    {
       return view('ledger-foundation::Livewire.wallet-transactions-list-component');
    }
}
