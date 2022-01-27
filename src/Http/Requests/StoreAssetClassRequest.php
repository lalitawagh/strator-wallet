<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetClassRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->user()->isSuperAdmin();
    }

    public function rules()
    {
        return [
            'name'        =>    ['required'],
            'image'       =>    ['nullable', 'image'],
            'status'      =>    ['nullable']
        ];
    }
}
