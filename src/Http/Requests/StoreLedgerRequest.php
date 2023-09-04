<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\Cms\Rules\AlphaSpaces;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Policies\LedgerPolicy;

class StoreLedgerRequest extends FormRequest
{
    public function authorize()
    {
        if ($this->user()->can(LedgerPolicy::CREATE, Ledger::class)) {
            return $this->user()->can(LedgerPolicy::CREATE, Ledger::class);
        }

        return $this->user()->can(LedgerPolicy::EDIT, Ledger::class);
    }

    public function rules()
    {
        return [
            'name'               => ['required', new AlphaSpaces,'unique:ledgers,name'],
            'code'               => ['required','regex:/^[A-Za-z\s]+$/u', 'max:40'],
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

    public function messages()
    {
        return [
            'code.regex' => 'The code field may only contain letters and spaces.',
            'code.max' => 'The code field cannot be longer than 40 characters.',
        ];
    }
}
