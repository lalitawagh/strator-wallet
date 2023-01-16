<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\LedgerFoundation\Contracts\Payout;
use Kanexy\LedgerFoundation\Policies\PayoutPolicy;

class StorePayoutRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(PayoutPolicy::CREATE, Payout::class);
    }

    public function rules()
    {
        return [
            'wallet'            => 'required',
            'balance'           => 'required',
            'beneficiary'       => 'required',
            'country_code'      => 'required',
            'phone'             => 'nullable',
            'amount'            => 'required',
            'remaining_amount'  => 'required',
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
            'balance.required'           => 'Check Your Balance Once.',
        ];
    }
}
