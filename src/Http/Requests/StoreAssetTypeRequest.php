<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\Cms\Rules\AlphaSpaces;
use Kanexy\LedgerFoundation\Contracts\AssetTypeConfiguration;
use Kanexy\LedgerFoundation\Policies\AssetTypePolicy;

class StoreAssetTypeRequest extends FormRequest
{
    public function authorize()
    {
        if($this->user()->can(AssetTypePolicy::CREATE, AssetTypeConfiguration::class))
        {
            return $this->user()->can(AssetTypePolicy::CREATE, AssetTypeConfiguration::class);
        }
        
        return $this->user()->can(AssetTypePolicy::EDIT, AssetTypeConfiguration::class);
    }

    public function rules()
    {
        return [
            'name'               =>    ['required', 'string', new AlphaSpaces],
            'asset_category'     =>    ['required'],
            'image'              =>    ['nullable', 'image'],
            'status'             =>    ['nullable'],
        ];
    }
}
