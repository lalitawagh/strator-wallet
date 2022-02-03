<?php

namespace Kanexy\LedgerFoundation\Enums;

use Kanexy\Cms\Enums\Enum;

class AssetCategory  extends Enum {
   public const FIAT_CURRENCY = 'fiat_currency';
   public const CRYPTO = 'crypto';
   public const COMMODITY = 'commodity';
   public const VIRTUAL = 'virtual';
}
