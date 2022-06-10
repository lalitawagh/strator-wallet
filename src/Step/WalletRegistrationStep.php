<?php

namespace Kanexy\LedgerFoundation\Step;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Enums\RegistrationStep;
use Kanexy\Cms\Enums\Role;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\Step\Contracts\Item;
use Kanexy\Cms\Step\StepItem;

class WalletRegistrationStep extends Item
{
    protected string $type = 'customers';

    protected string $flow = 'wallet_flow';

    protected string $role = Role::SUBSCRIBER;

    public function getItems(): array
    {
        $steps = [];
        $country = Country::find(Auth::user()?->country_id);

        if(!is_null($country?->code))
        {
            $steps = [
                new StepItem(membership_type: 'personal', label: 'Plan & Packages', step: RegistrationStep::PLAN_AND_PACKAGES ,source :'web', url: route('customer.signup.plan.index'),priority:2000),
                new StepItem(membership_type: 'personal', label: 'Address & DOB', step: RegistrationStep::ADDRESS ,source :'web', url: route('customer.signup.address.index'),priority:2000),
                new StepItem(membership_type: 'personal', label: 'KYC Documents', step: RegistrationStep::DOCUMENTS ,source :'web', url: route('customer.signup.kyc.index'),priority:2000),
            ];
        }

        return $steps;
    }
}

