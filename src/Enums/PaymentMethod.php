<?php

namespace Kanexy\LedgerFoundation\Enums;

use Kanexy\Cms\Enums\Enum;

class PaymentMethod extends Enum {
    // public const PAYPAL = 'paypal';
    public const STRIPE = 'stripe';
    public const MANUAL_TRANSFER = 'manual_transfer';
}
