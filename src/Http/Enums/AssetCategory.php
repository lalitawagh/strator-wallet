<?php

namespace Kanexy\LedgerFoundation\Http\Enums;

use Kanexy\Cms\Enums\Enum;

class AssetCategory  extends Enum {
   public const FIAT_CURRENCY = 'fiat_currency';
   public const CRYPTO = 'crypto';
   public const COMMODITY = 'commodity';
}
