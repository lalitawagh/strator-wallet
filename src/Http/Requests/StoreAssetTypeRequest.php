<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Policies\AssetTypePolicy;

class StoreAssetTypeRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(AssetTypePolicy::CREATE, Setting::class);
    }

    public function rules()
    {
        return [
            'name'               =>    ['required'],
            'asset_category'     =>    ['required'],
            'image'              =>    ['nullable', 'image'],
            'status'             =>    ['required'],
        ];
    }
}
