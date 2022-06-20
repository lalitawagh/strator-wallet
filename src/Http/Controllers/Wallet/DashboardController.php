<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\PartnerFoundation\Banking\Enums\TransactionStatus;
use Kanexy\PartnerFoundation\Banking\Enums\TransactionType;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Kanexy\PartnerFoundation\Core\Helper;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $workspace = $user->workspaces()->first();

        $transactions = Transaction::where("workspace_id", $workspace->id)->where('payment_method','wallet')->orWhere('meta->transaction_type','withdraw')->latest()->take(5)->get();

        $selectedYear = 2022;

        foreach (range(1, 12) as $m) {
            $months[] = date('F', mktime(0, 0, 0, $m, 1));
        }


         if ($user->isSubscriber() && !$user->is_banking_user) {
             $currentWorkspaceId = Helper::activeWorkspaceId();
             $creditTransactionGraphData = Transaction::whereWorkspaceId($currentWorkspaceId)->whereType(TransactionType::CREDIT)->whereYear("created_at", $selectedYear)->groupBy(["label"])->selectRaw("ROUND(sum(amount),2) as data, MONTHNAME(created_at) as label")->where('status', '!=', TransactionStatus::PENDING)->where('ref_type', 'wallet')->orWhere('meta->transaction_type','withdraw')->get();
             $debitTransactionGraphData = Transaction::whereWorkspaceId($currentWorkspaceId)->whereType(TransactionType::DEBIT)->whereYear("created_at", $selectedYear)->groupBy(["label"])->selectRaw("ROUND(sum(amount),2) as data, MONTHNAME(created_at) as label")->where('status', '!=', TransactionStatus::PENDING)->where('ref_type', 'wallet')->orWhere('meta->transaction_type','withdraw')->get();
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

         $creditTransactionGraphData = $creditTransactionGraphData;

         $debitTransactionGraphData = $debitTransactionGraphData;

        return view("ledger-foundation::wallet.dashboard", compact('transactions','creditTransactionGraphData','debitTransactionGraphData'));
    }
}
