<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\LedgerFoundation\Contracts\Payout;
use Kanexy\LedgerFoundation\Policies\PayoutPolicy;

class StoreStellarPayoutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'wallet'            => 'required',
            'beneficiary'       => 'required',
            'country_code'      => 'required',
            'phone'             => 'nullable',
            'amount'            => 'required',
            'receiver_currency' => 'required',
            'reference'         => 'required',
            'note'              => 'nullable',
            'attachment'        => 'nullable',
            'workspace_id'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'wallet.required'            => 'Please Select Transfer Account.',
            'receiver_currency.required' => 'Please Select Acceptor Account.',
            'beneficiary.required'       => 'Enter Beneficiary Account.',
            'amount.required'            => 'Enter the Amount to Pay.',
        ];
    }
}
