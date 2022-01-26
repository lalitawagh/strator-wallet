<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExchangeRateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
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
