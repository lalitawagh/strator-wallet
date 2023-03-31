<?php

namespace Kanexy\LedgerFoundation\Dtos;


class ExchangeToCryptoDto
{
    public string $transactionId;

    public string $amount;

    public string $type;

    public string $conversionCurrency;

    public string $beneficiaryPublicKey;

    public string $cardNumber;

    public string $month;

    public string $year;

    public string $cvv;

    public string $currency;

    public function __construct(array $data)
    {
        $this->transactionId = $data['transaction_id'];
        $this->amount = $data['amount'];
        $this->type = $data['type'];
        $this->conversionCurrency = $data['conversion_currency'];
        $this->beneficiaryPublicKey = $data['beneficiary_public_key'];
        $this->cardNumber = $data['card_number'];
        $this->month = $data['month'];
        $this->year = $data['year'];
        $this->cvv = $data['cvc'];
        $this->currency = $data['currency'];
    }

    public function toArray()
    {
        return [
            'transactionId' => $this->transactionId,
            'amount' => $this->amount,
            'type' =>$this->type, 
            'conversionCurrency' => $this->conversionCurrency,
            'beneficiaryPublicKey' => $this->beneficiaryPublicKey,
            'cardNumber' =>$this->cardNumber, 
            'month' => $this->month,
            'year' => $this->year,
            'cvv' => $this->cvv,
            'currency' =>$this->currency
        ];
    }
}
