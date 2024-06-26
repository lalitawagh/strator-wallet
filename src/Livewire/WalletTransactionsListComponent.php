<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Illuminate\Support\Facades\Auth;
use Kanexy\PartnerFoundation\Core\Models\Transaction;
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
        $user = Auth::user();
        $workspace = $user->workspaces()->first();

        $transactions = Transaction::where("ref_id", $walletID)->where("workspace_id", $workspace->id)->orWhere('meta->sender_wallet_account_id',$walletID)->latest()->take(15)->get();

        if (!empty($transactions)) {
            $this->transactions = $transactions;
        }
       
    }

    public function render()
    {
        return view('ledger-foundation::wallet.list-transactions');
    }
}
