<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Carbon\Carbon;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Dtos\CreateStellerAccountDto;
use Kanexy\LedgerFoundation\Enums\WalletStatus;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Services\StellerService;

class StellerController extends Controller
{
    protected StellerService $stellerService;

    public function __construct(StellerService $stellerService)
    {
        $this->stellerService = $stellerService;
    }

    public function  index()
    {
        return view('ledger-foundation::wallet.stellar.crypto-account');
    }

    public function  dashboard()
    {
        return view('ledger-foundation::wallet.stellar.dashboard');
    }


    public function createAccount()
    {
        $user = auth()->user();
        $workspace = $user->workspaces()->first();

        $data = [
            'date' => Carbon::now(),
            'partner_id' => config('app.name').' '.config('app.env'),
            'customer_id' => $workspace->id,
        ];

        $details = $this->stellerService->createAccount(
            new CreateStellerAccountDto($data)
        );


        $info = [
            "name" => $user->getFullName(),
            "urn" => Wallet::generateUrn(),
            "holder_type" => $workspace->getMorphClass(),
            "holder_id" => $workspace->getKey(),
            "balance" => 0,
            "status" => WalletStatus::ACTIVE,
            "type" => "steller",
            "meta" => [
                "publicKey" =>  $details['PublicKey'],
                "secretKey" =>  $details['SecretKey'],
                "date" => $details['Date'],
                "clientID" => $details['ClientID'],
                "custID" => $details['CustID'],
            ]
        ];

        $balanceDetail = $this->stellerService->getBalance($details['PublicKey']);

        Wallet::create($info);

        return redirect()->route('dashboard.wallet.wallet-dashboard')->with([
            'message' => 'Steller Account Created successfully.',
            'status' => 'success',
        ]);
    }

    public function getBalance()
    {
        $details = $this->stellerService->getBalance(
            'GDVK7DLQBNQW4UKAWBGWZJNJANJOPA4TTVECJ6XF35JDEMW6IO5M5DHI'
        );
        dd($details);
    }

}