<?php

namespace Kanexy\LedgerFoundation\Step;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Enums\RegistrationStep;
use Kanexy\Cms\Enums\Role;
use Kanexy\Cms\Step\Contracts\Item;
use Kanexy\Cms\Step\StepItem;

class PersonalRegistrationStep extends Item
{
    protected string $type = 'customers';

    protected string $flow = 'wallet_flow';

    protected string $role = Role::SUBSCRIBER;

    public function getItems(): array
    {
        return [];
    }
}

