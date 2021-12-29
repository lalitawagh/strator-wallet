<?php

namespace Kanexy\LedgerFoundation\Http\Enums;

use MyCLabs\Enum\Enum;

class AssetCategoryEnum  extends Enum {
   public const FIAT_CURRENCY = 'fiat_currency';
   public const NON_FIAT_CURRENCY = 'non_fiat_currency';
}
