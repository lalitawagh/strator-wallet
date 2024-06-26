<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\LedgerFoundation\Contracts\Withdraw;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Policies\WithdrawPolicy;

class WithdrawRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(WithdrawPolicy::CREATE, Withdraw::class);
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

    public function messages()
    {
        return [
            'sender_wallet_account_id.required'    => 'The withdraw from field is required.',
            'beneficiary_id.required' => 'The beneficiary field is required.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $senderAccountId = $this->input('sender_wallet_account_id');

            if (!is_null($senderAccountId)) {
                $senderAccount = Wallet::findOrFail($senderAccountId);
                $amount = (float) $this->input('amount');

                if ($senderAccount->balance < $amount) {
                    $validator->errors()->add('amount', 'Insufficient balance in the account.');
                }
            }
        });
    }


}
