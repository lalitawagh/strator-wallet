<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Policies\LedgerPolicy;

class StoreLedgerRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(LedgerPolicy::CREATE, Ledger::class);
    }

    public function rules()
    {
        return [
            'name'               => 'required',
            'code'               => 'required',
            'ledger_type'        => 'required',
            'symbol'             => 'required',
            'exchange_type'      => 'required',
            'exchange_rate'      => 'required',
            'exchange_from'      => 'required',
            'asset_category'     => 'required',
            'asset_class'        => 'required',
            'asset_type'         => 'required',
            'commodity_category' => 'required',
            'image'              => 'nullable',
            'payout_fee'         => 'required',
            'deposit_fee'        => 'required',
            'withdraw_fee'       => 'required',
            'status'             => 'required',
        ];
    }
}
