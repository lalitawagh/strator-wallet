<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Policies\CommodityTypePolicy;

class StoreCommodityRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(CommodityTypePolicy::CREATE, Setting::class);
    }

    public function rules()
    {
        return [
            'name'               =>    ['required'],
            'image'              =>    ['nullable', 'image'],
            'status'             =>    ['required'],
        ];
    }
}