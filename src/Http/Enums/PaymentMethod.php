<?php

namespace Kanexy\LedgerFoundation\Http\Enums;

use Kanexy\Cms\Enums\Enum;

class PaymentMethod extends Enum {
    public const BANK = 'bank';
    public const PAYPAL = 'paypal';
    public const STRIPE = 'stripe';
}
