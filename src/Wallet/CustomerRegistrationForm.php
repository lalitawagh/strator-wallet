<?php

namespace Kanexy\LedgerFoundation\Wallet;

use Kanexy\Cms\Form\Contracts\Item;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\I18N\Models\Nationality;
use Kanexy\Cms\Models\Title;
use Kanexy\Cms\Setting\Models\Setting;

class CustomerRegistrationForm extends Item
{
    public function validationRules(): array
    {

        return [
            'country_id' => ['required', 'exists:countries,id'],
            'nationality' => ['required_if:country_id,!=,UK'],
        ];
    }

    public function validationMessages(): array
    {
        return [
            'nationality.required_if' => 'Please enter your nationality',
            'country_id.required' => 'Please enter your residence',
        ];
    }

    public function render()
    {
        $isBankingUser = !is_null(request()->input("type")) ? 1 : 0;
        if($isBankingUser == 0)
        {
            $titles = Title::orderBy('id', 'asc')->pluck("name", "id");
            $nationalities = Nationality::pluck("nationality", "alpha_2_code");
            $countries = Country::orderBy("name")->pluck("name", "id");
            $countryWithFlags = Country::orderBy("name")->get();
            $defaultCountry= NULL;
            if(!is_null(Setting::getValue("wallet_default_country")))
            {
                $defaultCountry = Country::find(Setting::getValue("wallet_default_country"));
            }
            $user = NULL;
            return view("ledger-foundation::registration.customer-registration", compact("titles", "countries", "defaultCountry", "countryWithFlags", "isBankingUser", "nationalities", "user"));
        }
        
    }
}
