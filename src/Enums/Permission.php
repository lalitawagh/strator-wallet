<?php

namespace Kanexy\LedgerFoundation\Enums;

class Permission
{
    public const COMMODITY_TYPE_VIEW   = 'wallet::commodity_type.view';
    public const COMMODITY_TYPE_CREATE = 'wallet::commodity_type.create';
    public const COMMODITY_TYPE_EDIT   = 'wallet::commodity_type.edit';
    public const COMMODITY_TYPE_DELETE = 'wallet::commodity_type.delete';

    public const ASSET_TYPE_VIEW   = 'wallet::asset_type.view';
    public const ASSET_TYPE_CREATE = 'wallet::asset_type.create';
    public const ASSET_TYPE_EDIT   = 'wallet::asset_type.edit';
    public const ASSET_TYPE_DELETE = 'wallet::asset_type.delete';

    public const ASSET_CLASS_VIEW   = 'wallet::asset_class.view';
    public const ASSET_CLASS_CREATE = 'wallet::asset_class.create';
    public const ASSET_CLASS_EDIT   = 'wallet::asset_class.edit';
    public const ASSET_CLASS_DELETE = 'wallet::asset_class.delete';

    public const LEDGER_VIEW   = 'wallet::ledger.view';
    public const LEDGER_CREATE = 'wallet::ledger.create';
    public const LEDGER_EDIT   = 'wallet::ledger.edit';
    public const LEDGER_DELETE = 'wallet::ledger.delete';

    public const EXCHANGE_RATE_VIEW   = 'wallet::exchange_rate.view';
    public const EXCHANGE_RATE_CREATE = 'wallet::exchange_rate.create';
    public const EXCHANGE_RATE_EDIT   = 'wallet::exchange_rate.edit';
    public const EXCHANGE_RATE_DELETE = 'wallet::exchange_rate.delete';

    public const MASTER_ACCOUNT_VIEW   = 'wallet::master_account.view';
    public const MASTER_ACCOUNT_CREATE = 'wallet::master_account.create';
    public const MASTER_ACCOUNT_EDIT   = 'wallet::master_account.edit';
    public const MASTER_ACCOUNT_DELETE = 'wallet::master_account.delete';

    public const DEPOSIT_VIEW   = 'wallet::wallet_deposit.view';
    public const DEPOSIT_CREATE = 'wallet::wallet_deposit.create';
    public const DEPOSIT_SHOW   = 'wallet::wallet_deposit.show';

    public const PAYOUT_VIEW   = 'wallet::wallet_payout.view';
    public const PAYOUT_CREATE = 'wallet::wallet_payout.create';
    public const PAYOUT_SHOW   = 'wallet::wallet_payout.show';

    public const WITHDRAW_VIEW   = 'wallet::wallet_withdraw.view';
    public const WITHDRAW_CREATE = 'wallet::wallet_withdraw.create';
    public const WITHDRAW_SHOW   = 'wallet::wallet_withdraw.show';

    public const FEE_VIEW   = 'wallet::fee.view';
    public const FEE_CREATE = 'wallet::fee.create';
    public const FEE_EDIT   = 'wallet::fee.show';
    public const FEE_DELETE   = 'wallet::fee.delete';
}
