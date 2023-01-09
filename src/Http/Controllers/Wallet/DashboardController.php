<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Services\StellerService;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;

class DashboardController extends Controller
{
    protected StellerService $stellerService;

    public function __construct(StellerService $stellerService)
    {
        $this->stellerService = $stellerService;
    }

    public function index()
    {
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $wallets = Wallet::whereHolderId($workspace?->id)->get();
        $transactions = Transaction::where("workspace_id", $workspace?->id)->where('meta->account','wallet')->latest()->take(5)->get();
        $stellerAccount = Wallet::whereHolderId($workspace?->id)->whereType('steller')->first();
        if(!is_null($stellerAccount))
        {
            $stellerBalance = $this->stellerService->getBalance($stellerAccount?->meta['publicKey']);
            if(isset($stellerBalance['balance']))
            {
                $stellerAccount->balance = $stellerBalance['balance'][0]['balance'];
                $stellerAccount->update();
            }
        }
       
        return view("ledger-foundation::wallet.dashboard", compact('transactions', 'workspace', 'wallets', 'stellerAccount'));
    }
}
