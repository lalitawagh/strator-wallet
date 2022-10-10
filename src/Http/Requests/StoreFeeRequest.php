<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\LedgerFoundation\Contracts\Fee;
use Kanexy\LedgerFoundation\Policies\FeePolicy;

class StoreFeeRequest extends FormRequest
{
    public function authorize()
    {
        if($this->user()->can(FeePolicy::CREATE, Fee::class))
        {
            return $this->user()->can(FeePolicy::CREATE, Fee::class);
        }

        return $this->user()->can(FeePolicy::EDIT, Fee::class);
    }

    public function rules()
    {
        return [
            'base_currency'          =>    ['required'],
            'exchange_currency'      =>    ['required'],
            'payment_type'           =>    ['required'],
            'fee_type'               =>    ['required'],
            'amount'                 =>    ['required_if:fee_type,==,amount','nullable','numeric','min:0'],
            'percentage'             =>    ['required_if:fee_type,==,percentage','nullable','numeric','between:0,100'],
            'status'                 =>    ['nullable','string'],

        ];
    }

}
