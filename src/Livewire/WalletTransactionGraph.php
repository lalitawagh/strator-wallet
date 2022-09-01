<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Illuminate\Support\Facades\Auth;
use Kanexy\PartnerFoundation\Banking\Enums\TransactionType;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Kanexy\PartnerFoundation\Core\Helper;
use Livewire\Component;

class WalletTransactionGraph extends Component
{
    public $wallets;

    public $creditWalletTransactionGraphData;

    public $debitWalletTransactionGraphData;

    public $selected_wallet;

    public function mount($wallets)
    {
        $this->wallets = $wallets;
        $value = $wallets->first()?->id;

        $user = Auth::user();
        foreach (range(1, 12) as $m) {
            $months[] = date('F', mktime(0, 0, 0, $m, 1));
        }

        $currentWorkspaceId = app('activeWorkspaceId');
        $creditTransactionGraphData = Transaction::whereWorkspaceId($currentWorkspaceId)->whereType(TransactionType::CREDIT)->whereRefId($value)->groupBy(["label"])->selectRaw("ROUND(sum(amount),2) as data, MONTHNAME(created_at) as label")->where('meta->account', 'wallet')->get();

        $debitTransactionGraphData = Transaction::whereWorkspaceId($currentWorkspaceId)->whereType(TransactionType::DEBIT)->whereRefId($value)->groupBy(["label"])->selectRaw("ROUND(sum(amount),2) as data, MONTHNAME(created_at) as label")->where('meta->account', 'wallet')->get();
        $withdrawTransaction = Transaction::whereWorkspaceId($currentWorkspaceId)->whereType(TransactionType::DEBIT)->where('meta->sender_wallet_account_id', $value)->groupBy(["label"])->selectRaw("ROUND(sum(amount),2) as data, MONTHNAME(created_at) as label")->where('meta->account', 'wallet')->get();

        if(!is_null($debitTransactionGraphData) && !is_null($withdrawTransaction))
        {
            $debitTransactionGraphData = $debitTransactionGraphData->merge($withdrawTransaction);
        }

        $creditTransactionGraphData = collect($months)->map(function ($month) use ($creditTransactionGraphData) {
        $record = $creditTransactionGraphData->where('label', $month)->first();

            if (!is_null($record)) {
                return $record->data;
            }

            return 0;
        });

        $debitTransactionGraphData = collect($months)->map(function ($month) use ($debitTransactionGraphData) {
            $record = $debitTransactionGraphData->where('label', $month)->first();

            if (!is_null($record)) {
                return $record->data;
            }

            return 0;
        });

        $this->creditWalletTransactionGraphData = $creditTransactionGraphData;

        $this->debitWalletTransactionGraphData = $debitTransactionGraphData;

        $this->dispatchBrowserEvent('UpdateWalletTransactionChart');
    }

    public function getWalletTransaction($value)
    {
        $this->dispatchBrowserEvent('UpdateLivewireSelect');

        $user = Auth::user();
        foreach (range(1, 12) as $m) {
            $months[] = date('F', mktime(0, 0, 0, $m, 1));
        }

        $currentWorkspaceId = app('activeWorkspaceId');
        $creditTransactionGraphData = Transaction::whereWorkspaceId($currentWorkspaceId)->whereType(TransactionType::CREDIT)->whereRefId($value)->groupBy(["label"])->selectRaw("ROUND(sum(amount),2) as data, MONTHNAME(created_at) as label")->where('meta->account', 'wallet')->get();

        $debitTransactionGraphData = Transaction::whereWorkspaceId($currentWorkspaceId)->whereType(TransactionType::DEBIT)->whereRefId($value)->groupBy(["label"])->selectRaw("ROUND(sum(amount),2) as data, MONTHNAME(created_at) as label")->where('meta->account', 'wallet')->get();
        $withdrawTransaction = Transaction::whereWorkspaceId($currentWorkspaceId)->whereType(TransactionType::DEBIT)->where('meta->sender_wallet_account_id', $value)->groupBy(["label"])->selectRaw("ROUND(sum(amount),2) as data, MONTHNAME(created_at) as label")->where('meta->account', 'wallet')->get();

        if(!is_null($debitTransactionGraphData) && !is_null($withdrawTransaction))
        {
            $debitTransactionGraphData = $debitTransactionGraphData->merge($withdrawTransaction);
        }
        $creditTransactionGraphData = collect($months)->map(function ($month) use ($creditTransactionGraphData) {
            $record = $creditTransactionGraphData->where('label', $month)->first();

            if (!is_null($record)) {
                return $record->data;
            }

            return 0;
        });

        $debitTransactionGraphData = collect($months)->map(function ($month) use ($debitTransactionGraphData) {
            $record = $debitTransactionGraphData->where('label', $month)->first();

            if (!is_null($record)) {
                return $record->data;
            }

            return 0;
        });

        $this->creditWalletTransactionGraphData = $creditTransactionGraphData;

        $this->debitWalletTransactionGraphData = $debitTransactionGraphData;

        $this->selected_wallet = $value;

        $this->dispatchBrowserEvent('UpdateWalletTransactionChart');
    }

    public function render()
    {
        return view('ledger-foundation::Livewire.wallet-transaction-graph');
    }
}
