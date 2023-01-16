<?php

namespace Kanexy\LedgerFoundation\Step;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Enums\RegistrationStep;
use Kanexy\Cms\Enums\Role;
use Kanexy\Cms\I18N\Models\Country;
use Kanexy\Cms\Step\Contracts\Item;
use Kanexy\Cms\Step\StepItem;
use Kanexy\PartnerFoundation\Core\Enums\MembershipType;

class WalletRegistrationStep extends Item
{
    protected string $type = 'customers';

    protected string $flow = 'wallet_flow';

    protected string $role = Role::SUBSCRIBER;

    public int $priority = 5000;

    public function getItems(): array
    {
        $steps = [];
        $country = Country::find(Auth::user()?->country_id);
        $workspace = Auth::user()->workspaces()->first();

        if(!is_null($country?->code) && $country?->code != 'UK' && config('standard_kyc_wallet') == false)
        {
            $steps = [
                new StepItem(membership_type: 'personal', label: 'Plan & Packages', step: RegistrationStep::PLAN_AND_PACKAGES ,source :'web', url: route('customer.signup.plan.index'),priority:2000),
                new StepItem(membership_type: 'personal', label: 'Address & DOB', step: RegistrationStep::ADDRESS ,source :'web', url: route('customer.signup.address.index'),priority:2000),
                new StepItem(membership_type: 'personal', label: 'KYC Documents', step: RegistrationStep::DOCUMENTS ,source :'web', url: route('customer.signup.kyc.index'),priority:2000),
            ];
        }elseif(config('services.standard_kyc_wallet') == true)
        {
            $steps = [
                new StepItem(membership_type: 'business', label: 'Plan & Packages', step: RegistrationStep::PLAN_AND_PACKAGES ,source :'web', url: route('customer.signup.plan.index'),priority:2000),
                new StepItem(membership_type: 'business', label: 'Address & DOB', step: RegistrationStep::ADDRESS ,source :'web', url: route('customer.signup.address.index'),priority:2000),
                new StepItem(membership_type: 'business', label: 'KYC Documents', step: RegistrationStep::DOCUMENTS ,source :'web', url: route('customer.signup.kyc.index'),priority:2000),
            ];

          
            if($workspace->type == MembershipType::BUSINESS && $country?->code == 'UK')
            {
                
                $steps[] = new StepItem(membership_type: 'business', label: 'Company Details', step: RegistrationStep::COMPANY_REGISTRATION ,source :'web', url: route('customer.signup.company-registration.index'),priority:2000);
                $steps[] = new StepItem(membership_type: 'business', label: 'Company Address', step: RegistrationStep::COMPANY_ADDRESS ,source :'web', url: route('customer.signup.company-address.index'),priority:2000);
                $steps[] = new StepItem(membership_type: 'business', label: 'Company Officers', step: RegistrationStep::COMPANY_OFFICERS ,source :'web', url: route('customer.signup.company-officers.index'),priority:2000);    
            }

            if($workspace->is_registered != 1 && $country?->code == 'UK')
            {
                $steps[] = new StepItem(membership_type: 'business', label: 'KYB Documents', step: RegistrationStep::COMPANY_DOCUMENTS ,source :'web', url: route('customer.signup.company-documents.index'),priority:2000);
            }
        }
       
        return $steps;
    }
}

