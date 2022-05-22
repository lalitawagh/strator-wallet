<?php

namespace Kanexy\LedgerFoundation\Step;

use Kanexy\Cms\Enums\Role;
use Kanexy\Cms\Step\Contracts\Item;

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

