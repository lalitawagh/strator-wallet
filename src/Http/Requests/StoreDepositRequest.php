<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Policies\DepositPolicy;

class StoreDepositRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(DepositPolicy::CREATE, Wallet::class);
    }

    public function rules()
    {
        return [
            'wallet'            => 'required',
            'currency'          => 'required',
            'amount'            => ['required', 'numeric'],
            'reference'         => 'required',
            'payment_method'    => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'wallet' => 'Deposit To',
            'currency' => 'Deposit From',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $exchange_asset_category = session('exchange_asset_category');

            if ($exchange_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY) {
                if (is_null($this->input('payment_method'))) {
                    $validator->errors()->add('payment_method', 'Payment method field is required');
                }
            }

            $asset_type = collect(Setting::getValue('asset_types', []))->firstWhere('id', $this->input('currency'));
            if (is_null($asset_type)) {
                $validator->errors()->add('currency', 'Currency not exists');
            }

            if ($asset_type['name'] == 'INR') {
                if ($this->input('amount') < 50) {
                    $validator->errors()->add('amount', 'The smallest amount you can send is 50 INR.');
                }
            }
        });
    }
}
