<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Illuminate\Support\Facades\Auth;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Livewire\Component;

class WalletTransactionsListComponent extends Component
{
    public $wallet_id;

    public $transactions = [];

    protected $listeners = [
        'transactionList',
    ];

    public function transactionList($walletID)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->isSubscriber()) {
            $transactions = Transaction::where("ref_id", $walletID)->latest()->take(15)->get();
        } else {
            $transactions = Transaction::where('ref_type','wallet')->latest()->get();
        }

        if(!empty($transactions)){
            $this->transactions = $transactions;
        }
    }

    public function render()
    {
       return view('ledger-foundation::Livewire.wallet-transactions-list-component');
    }
}
