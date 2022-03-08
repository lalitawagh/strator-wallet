<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\LedgerFoundation\Contracts\AssetClassConfiguration;
use Kanexy\LedgerFoundation\Policies\AssetClassPolicy;

class StoreAssetClassRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(AssetClassPolicy::CREATE, AssetClassConfiguration::class);
    }

    public function rules()
    {
        return [
            'name'        =>    ['required'],
            'image'       =>    ['nullable', 'image'],
            'status'      =>    ['nullable'],
        ];
    }
}
