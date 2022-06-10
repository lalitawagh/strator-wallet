<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\LedgerFoundation\Contracts\AssetClassConfiguration;
use Kanexy\LedgerFoundation\Policies\AssetClassPolicy;

class StoreMasterAccountRequest extends FormRequest
{
    public function authorize()
    {
        // return $this->user()->can(AssetClassPolicy::CREATE, AssetClassConfiguration::class);
        return true;
    }

    public function rules()
    {
        return [
            'country'               =>    ['required','exists:countries,id'],
            'status'                =>    ['required'],
            'account_holder_name'   =>    ['required','string'],
            'account_branch'        =>    ['required','string'],
            'account_number'        =>    ['required','numeric','digits:8'],
            'sort_code'             =>    ['required','numeric','digits:6'],
        ];
    }
}
