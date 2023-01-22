<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Dtos\CreateStellerAccountDto;
use Kanexy\LedgerFoundation\Enums\WalletStatus;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Services\StellerService;
use Kanexy\PartnerFoundation\Core\Helper;

class StellerController extends Controller
{
    protected StellerService $stellerService;

    public function __construct(StellerService $stellerService)
    {
        $this->stellerService = $stellerService;
    }

    public function  index()
    {
        $stellarAccount = Wallet::whereHolderId(Helper::activeWorkspaceId())->whereType('steller')->first();
        if(!is_null($stellarAccount))
        {
            $stellarBalance = $this->stellerService->getBalance($stellarAccount?->meta['publicKey']);
            if(isset($stellarBalance['balance']))
            {
                $stellarAccount->balance = $stellarBalance['balance'][0]['balance'];
                $stellarAccount->update();
            }
        }
        session()->forget('stellar_request');

        return view('ledger-foundation::wallet.stellar.crypto-account',compact('stellarAccount'));
    }

    public function  dashboard()
    {
        $stellarAccount = Wallet::whereHolderId(Helper::activeWorkspaceId())->whereType('steller')->first();
        if(!is_null($stellarAccount))
        {
            $stellarBalance = $this->stellerService->getBalance($stellarAccount?->meta['publicKey']);
            if(isset($stellarBalance['balance']))
            {
                $stellarAccount->balance = $stellarBalance['balance'][0]['balance'];
                $stellarAccount->update();
            }
        }

        return view('ledger-foundation::wallet.stellar.dashboard',compact('stellarAccount'));
    }

    public function exchangeRateView()
    {
        $exchangedAmount = NULL;
        $currency = NULL;
        $conversionCurrency = NULL;
        $amount = NULL;
        return view('ledger-foundation::wallet.stellar.stellar-exchange-rate',compact('amount','exchangedAmount','currency','conversionCurrency'));
    }

    public function getExchangeRate(Request $request)
    {
        $data = $request->all();
       
        $info = [
            'type' => 0,
            'amount' => $data['amount'],
            'currency' => $data['from'],
            'conversionCurrency' => $data['to'],
        ];
        
        $details = $this->stellerService->getExchangeRate($info);

        $exchangedAmount = $details['exchangedAmount'];
        $currency = $data['from'];
        $conversionCurrency = $data['to'];
        $amount = $data['amount'];

        return view('ledger-foundation::wallet.stellar.stellar-exchange-rate',compact('amount','exchangedAmount','currency','conversionCurrency'));
       
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

        return redirect()->route('dashboard.wallet.crypto-account', ['filter' => ['workspace_id' => Helper::activeWorkspaceId()]])->with([
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
