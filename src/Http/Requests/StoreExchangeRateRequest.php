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
            'valid_date'             =>    ['required'],
            'is_hard_stop'           =>    ['required'],
            'exchange_fee'           =>    ['required'],
            'exchange_rate'          =>    ['required'],
            'note'                   =>    ['required'],
        ];
    }
}
