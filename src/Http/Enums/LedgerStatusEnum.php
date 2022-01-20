<?php

namespace Kanexy\LedgerFoundation\Http\Enums;

use MyCLabs\Enum\Enum;

class LedgerStatusEnum extends Enum {
    public const NEW = 'new';
    public const ACTIVE = 'active';
    public const INACTIVE = 'inactive';
    public const HOLD = 'hold';
    public const SUSPENDED = 'suspended';
}
