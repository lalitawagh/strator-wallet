<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\LedgerFoundation\Contracts\Payout;
use Kanexy\LedgerFoundation\Policies\PayoutPolicy;

class WithdrawRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "sender_wallet_account_id" => ["required"],
            "beneficiary_id" => ["required", "exists:contacts,id"],
            "reference" => ["nullable", "string"],
            "amount" => ["required", "numeric", "min:0.01"],
            "note" => ["nullable", "string"],
            "attachment" => ["nullable", "max:5120", "mimes:png,jpg,jpeg", "file"],
        ];
    }
}
