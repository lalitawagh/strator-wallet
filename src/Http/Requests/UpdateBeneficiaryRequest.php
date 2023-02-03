<?php

namespace Kanexy\LedgerFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Kanexy\Cms\Rules\AlphaSpaces;
use Kanexy\Cms\Rules\MobileNumber;
use Kanexy\PartnerFoundation\Cxrm\Policies\ContactPolicy;

class UpdateBeneficiaryRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can(ContactPolicy::EDIT, $this->route('beneficiary'));
    }

    public function rules()
    {
        return [
            'first_name' => ['required', new AlphaSpaces, 'string'],
            'middle_name' => ['nullable', new AlphaSpaces, 'string'],
            'last_name' => ['nullable', new AlphaSpaces, 'string'],
            'email' => ['nullable', 'email'],
            'mobile' => ['nullable', new MobileNumber],
            'nick_name' => ['nullable', 'string']
        ];
    }
}
