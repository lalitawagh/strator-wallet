<?php

namespace Kanexy\LedgerFoundation\Http\Enums;

use MyCLabs\Enum\Enum;

class AssetCategoryEnum  extends Enum {
   public const FIAT_CURRENCY = 'fiat_currency';
   public const CRYPTO = 'crypto';
   public const COMMODITY = 'commodity';
}
