<?php

namespace Kanexy\LedgerFoundation\Http\Enums;

use Kanexy\Cms\Enums\Enum;

class LedgerStatus extends Enum {
    public const NEW = 'new';
    public const ACTIVE = 'active';
    public const INACTIVE = 'inactive';
    public const HOLD = 'hold';
    public const SUSPENDED = 'suspended';
}
