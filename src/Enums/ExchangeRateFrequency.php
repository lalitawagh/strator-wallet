<?php

namespace Kanexy\LedgerFoundation\Enums;

use Kanexy\Cms\Enums\Enum;

class ExchangeRateFrequency extends Enum {
   public const DAILY = 'daily';
   public const WEEKLY = 'weekly';
   public const MONTHLY = 'monthly';
   public const QUARTERLY = 'quarterly';
   public const YEARLY = 'yearly';
}
