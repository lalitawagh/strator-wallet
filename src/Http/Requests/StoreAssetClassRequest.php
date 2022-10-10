<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\Cms\Rules\AlphaSpaces;
use Kanexy\LedgerFoundation\Contracts\AssetClassConfiguration;
use Kanexy\LedgerFoundation\Policies\AssetClassPolicy;

class StoreAssetClassRequest extends FormRequest
{
    public function authorize()
    {
        if($this->user()->can(AssetClassPolicy::CREATE, AssetClassConfiguration::class))
        {
            return $this->user()->can(AssetClassPolicy::CREATE, AssetClassConfiguration::class);
        }
        
        return $this->user()->can(AssetClassPolicy::EDIT, AssetClassConfiguration::class);
    }

    public function rules()
    {
        return [
            'name'        =>    ['required','string', new AlphaSpaces],
            'image'       =>    ['nullable', 'image'],
            'status'      =>    ['nullable'],
        ];
    }
}
