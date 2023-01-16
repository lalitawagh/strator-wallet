<?php

namespace Kanexy\LedgerFoundation\Dtos;


class CreateStellerAccountDto
{
    public string $date;

    public string $partner_id;

    public string $customer_id;

    public function __construct(array $data)
    {
        $this->date = $data['date'];
        $this->partner_id = $data['partner_id'];
        $this->customer_id = $data['customer_id'];
    }

    public function toArray()
    {
        return [
            'Date' => $this->date,
            'ClientID' => $this->partner_id,
            'CustID' =>$this->customer_id, 
        ];
    }
}
