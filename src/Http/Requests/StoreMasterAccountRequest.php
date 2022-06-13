<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Kanexy\LedgerFoundation\Contracts\MasterAccount;
use Kanexy\LedgerFoundation\Policies\MasterAccountPolicy;

class StoreMasterAccountRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(MasterAccountPolicy::CREATE, MasterAccount::class);
    }

    public function rules()
    {
        return [
            'country'               =>    ['required','exists:countries,id'],
            'status'                =>    ['required'],
            'account_holder_name'   =>    ['required','string'],
            'account_branch'        =>    ['required','string'],
            'account_number'        =>    ['required','numeric'],
            'sort_code'             =>    [Rule::requiredIf(request()->get('country') == 231),'nullable','numeric','digits:6'],
            'ifsc_code'             =>    [Rule::requiredIf(request()->get('country') != 231),'nullable','numeric'],
        ];
    }
}