<?php

namespace Kanexy\LedgerFoundation\Services;

use Illuminate\Support\Facades\Http;
use Kanexy\LedgerFoundation\Dtos\CreateStellerAccountDto;
use Kanexy\LedgerFoundation\Dtos\ExchangeToCryptoDto;

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
        try {
            $url = 'https://kanexy-stellar-uat.azurewebsites.net/api/stellar/getBalance/'.$publicKey;
       
            $response =  Http::acceptJson()->get($url)
                ->throw()
                ->json();
            $response['code'] = 200;
        } catch (\Throwable $th) {
            $response['code'] = 400;
            $response['message'] = $th->getMessage();
        }
        return $response;
    }

    public function exchangeToCrypto(ExchangeToCryptoDto $exchangeToCryptoDto)
    {
        return Http::acceptJson()
            ->post('https://kanexy-stellar-uat.azurewebsites.net/api/stellar/exchangeToCrypto', $exchangeToCryptoDto->toArray())
            ->throw()
            ->json();
    }

    public function getExchangeRate($details)
    {
        return Http::acceptJson()
            ->get('https://kanexy-stellar-uat.azurewebsites.net/api/stellar/getExchangeRate/?type=0&amount='.$details['amount'].'&currency='.$details['currency'].'&conversionCurrency='.$details['conversionCurrency'].'')
            ->throw()
            ->json();
    }

    public function getCurrentRate($currency)
    {
        return Http::acceptJson()
            ->get('https://kanexy-stellar-uat.azurewebsites.net/api/stellar/getCryptoPrice/'.$currency.'')
            ->throw()
            ->json();
    }

    
}
