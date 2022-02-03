<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Policies\PayoutPolicy;

class StorePayoutRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(PayoutPolicy::CREATE, Wallet::class);
    }

    public function rules()
    {
        return [
            'wallet'            => 'required',
            'balance'           => 'required',
            'beneficiary'       => 'required',
            'country_code'      => 'nullable',
            'phone'             => 'required',
            'amount'            => 'required',
            'remaining_amount'  => 'required',
            'receiver_currency' => 'required',
            'reference'         => 'required',
            'note'              => 'nullable',
            'attachment'        => 'nullable',
            'workspace_id'      => 'required',
        ];
    }
}
