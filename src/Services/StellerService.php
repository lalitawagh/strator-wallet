<?php

namespace Kanexy\LedgerFoundation\Services;

use Illuminate\Support\Facades\Http;
use Kanexy\LedgerFoundation\Dtos\CreateStellerAccountDto;

class StellerService
{
    public function createAccount(CreateStellerAccountDto $createStellerAccountDto)
    {
        return Http::acceptJson()
            ->post('https://kanexy-stellar-uat.azurewebsites.net/api/stellar/createAccount', $createStellerAccountDto->toArray())
            ->throw()
            ->json();
    }

    public function getBalance($publicKey)
    {
        $url = 'https://kanexy-stellar-uat.azurewebsites.net/api/stellar/getBalance/'.$publicKey;
       
        return Http::acceptJson()->get($url)
            ->throw()
            ->json();
    }
}
