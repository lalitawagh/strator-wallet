<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\LedgerFoundation\Model\ExchangeRate;
use Kanexy\LedgerFoundation\Policies\ExchangeRatePolicy;

class StoreExchangeRateRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(ExchangeRatePolicy::CREATE, ExchangeRate::class);
    }

    public function rules()
    {
        return [
            'base_currency'          =>    ['required'],
            'exchange_currency'      =>    ['required'],
            'frequency'              =>    ['required'],
            'valid_date'             =>    ['nullable'],
            'is_hard_stop'           =>    ['nullable'],
            'exchange_fee'           =>    ['required'],
            'exchange_rate'          =>    ['required'],
            'note'                   =>    ['required'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->has('is_hard_stop') && is_null($this->input('valid_date'))) {
                $validator->errors()->add('valid_date', 'Valid Date field is required');
            }
        });
    }
}
