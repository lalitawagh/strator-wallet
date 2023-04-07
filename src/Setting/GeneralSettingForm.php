<?php

namespace Kanexy\LedgerFoundation\Setting;

use Kanexy\Cms\Form\Contracts\Item;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\PartnerFoundation\Saas\Models\Plan;

class GeneralSettingForm extends Item
{
    public function validationRules(): array
    {
        return [
            'wallet_default_country' => ['nullable', 'exists:countries,id'],
        ];
    }

    public function render()
    {
        $settings = Setting::pluck('value', 'key');
       
        return view("ledger-foundation::setting.general-setting-form", compact('settings'));
    }
}
