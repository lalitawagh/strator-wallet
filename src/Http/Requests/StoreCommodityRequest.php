<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\Cms\Rules\AlphaSpaces;
use Kanexy\LedgerFoundation\Contracts\CommodityTypeConfiguration;
use Kanexy\LedgerFoundation\Policies\CommodityTypePolicy;

class StoreCommodityRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(CommodityTypePolicy::CREATE, CommodityTypeConfiguration::class);
    }

    public function rules()
    {
        return [
            'name'               =>    ['required','string', new AlphaSpaces],
            'image'              =>    ['nullable', 'image'],
            'status'             =>    ['nullable'],
        ];
    }
}
