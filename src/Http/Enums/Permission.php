<?php

namespace Kanexy\LedgerFoundation\Http\Enums;

class Permission
{
    public const COMMODITY_TYPE_VIEW   = 'ledger-foundation::commodity-type.view';
    public const COMMODITY_TYPE_CREATE = 'ledger-foundation::commodity-type.create';
    public const COMMODITY_TYPE_EDIT   = 'ledger-foundation::commodity-type.edit';
    public const COMMODITY_TYPE_DELETE = 'ledger-foundation::commodity-type.delete';

    public const ASSET_TYPE_VIEW   = 'ledger-foundation::asset-type.view';
    public const ASSET_TYPE_CREATE = 'ledger-foundation::asset-type.create';
    public const ASSET_TYPE_EDIT   = 'ledger-foundation::asset-type.edit';
    public const ASSET_TYPE_DELETE = 'ledger-foundation::asset-type.delete';

    public const ASSET_CLASS_VIEW   = 'ledger-foundation::asset-class.view';
    public const ASSET_CLASS_CREATE = 'ledger-foundation::asset-class.create';
    public const ASSET_CLASS_EDIT   = 'ledger-foundation::asset-class.edit';
    public const ASSET_CLASS_DELETE = 'ledger-foundation::asset-class.delete';

    public const LEDGER_VIEW   = 'ledger-foundation::ledger.view';
    public const LEDGER_CREATE = 'ledger-foundation::ledger.create';
    public const LEDGER_EDIT   = 'ledger-foundation::ledger.edit';
    public const LEDGER_DELETE = 'ledger-foundation::ledger.delete';

    public const PAYOUT_VIEW   = 'ledger-foundation::wallet.payout.view';
    public const PAYOUT_CREATE = 'ledger-foundation::wallet.payout.create';
    public const PAYOUT_SHOW   = 'ledger-foundation::wallet.payout.show';
}
