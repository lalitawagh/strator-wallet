<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLedgerRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->user()->isSuperAdmin();
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
            'status'             => 'nullable',
        ];
    }
}
