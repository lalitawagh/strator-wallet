<?php

namespace Kanexy\LedgerFoundation\Enums;

class Permission
{
    public const COMMODITY_TYPE_VIEW   = 'ledger-foundation::commodity_type.view';
    public const COMMODITY_TYPE_CREATE = 'ledger-foundation::commodity_type.create';
    public const COMMODITY_TYPE_EDIT   = 'ledger-foundation::commodity_type.edit';
    public const COMMODITY_TYPE_DELETE = 'ledger-foundation::commodity_type.delete';

    public const ASSET_TYPE_VIEW   = 'ledger-foundation::asset_type.view';
    public const ASSET_TYPE_CREATE = 'ledger-foundation::asset_type.create';
    public const ASSET_TYPE_EDIT   = 'ledger-foundation::asset_type.edit';
    public const ASSET_TYPE_DELETE = 'ledger-foundation::asset_type.delete';

    public const ASSET_CLASS_VIEW   = 'ledger-foundation::asset_class.view';
    public const ASSET_CLASS_CREATE = 'ledger-foundation::asset_class.create';
    public const ASSET_CLASS_EDIT   = 'ledger-foundation::asset_class.edit';
    public const ASSET_CLASS_DELETE = 'ledger-foundation::asset_class.delete';

    public const LEDGER_VIEW   = 'ledger-foundation::ledger.view';
    public const LEDGER_CREATE = 'ledger-foundation::ledger.create';
    public const LEDGER_EDIT   = 'ledger-foundation::ledger.edit';
    public const LEDGER_DELETE = 'ledger-foundation::ledger.delete';

    public const EXCHANGE_RATE_VIEW   = 'ledger-foundation::exchange_rate.view';
    public const EXCHANGE_RATE_CREATE = 'ledger-foundation::exchange_rate.create';
    public const EXCHANGE_RATE_EDIT   = 'ledger-foundation::exchange_rate.edit';
    public const EXCHANGE_RATE_DELETE = 'ledger-foundation::exchange_rate.delete';

    public const DEPOSIT_VIEW   = 'ledger-foundation::wallet_deposit.view';
    public const DEPOSIT_CREATE = 'ledger-foundation::wallet_deposit.create';
    public const DEPOSIT_SHOW   = 'ledger-foundation::wallet_deposit.show';

    public const PAYOUT_VIEW   = 'ledger-foundation::wallet_payout.view';
    public const PAYOUT_CREATE = 'ledger-foundation::wallet_payout.create';
    public const PAYOUT_SHOW   = 'ledger-foundation::wallet_payout.show';
}
