<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Policies\LedgerPolicy;

class StoreLedgerRequest extends FormRequest
{
    public function authorize()
    {
        if($this->user()->can(LedgerPolicy::CREATE, Ledger::class))
        {
            return $this->user()->can(LedgerPolicy::CREATE, Ledger::class);
        }
        
        return $this->user()->can(LedgerPolicy::EDIT, Ledger::class);
    }

    public function rules()
    {
        return [
            'name'               => 'required',
            'code'               => 'required',
            'ledger_type'        => 'required',
            'symbol'             => 'nullable',
            'exchange_type'      => 'required',
            'exchange_rate'      => 'nullable',
            'exchange_from'      => 'required',
            'asset_category'     => 'required',
            'asset_class'        => 'required',
            'asset_type'         => 'required',
            'commodity_category' => 'required_if:asset_category,commodity',
            'image'              => 'nullable',
            'status'             => 'required',
        ];
    }
}
