<?php

namespace Kanexy\LedgerFoundation\Menu;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Menu\Contracts\Item;
use Kanexy\Cms\Menu\MenuItem;
use Kanexy\LedgerFoundation\Enums\Permission;
use Kanexy\LedgerFoundation\Http\Helper as HttpHelper;
use Kanexy\PartnerFoundation\Core\Helper;

class WalletMenuItem extends Item
{
    public int $priority = 9998;

    protected string $label = 'Wallet';

    protected string $icon = 'cast';

    public function getIsVisible(): bool
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasAnyPermission([Permission::PAYOUT_VIEW, Permission::DEPOSIT_VIEW, Permission::COMMODITY_TYPE_VIEW, Permission::ASSET_CLASS_VIEW, Permission::ASSET_TYPE_VIEW, Permission::FEE_VIEW, Permission::MASTER_ACCOUNT_VIEW, Permission::LEDGER_VIEW, Permission::EXCHANGE_RATE_VIEW])) {
            return true;
        }

        return false;
    }

    public function getSubmenu(): array
    {
        /** @var $user App\Model\User */
        $user = Auth::user();

        $menus = [
            new MenuItem('Transactions', 'activity', url: route('dashboard.wallet.transaction.index', ['filter' => ['workspace_id' => Helper::activeWorkspaceId()]])),
        ];

        if ($user->hasPermissionTo(Permission::WITHDRAW_VIEW)) {
            $menus[] =  new MenuItem('Withdraw', 'activity', url: route('dashboard.wallet.withdraw.index', ['filter' => ['workspace_id' => Helper::activeWorkspaceId()]]));
        }

        if ($user->hasPermissionTo(Permission::PAYOUT_VIEW)) {
            $menus[] = new MenuItem('Transfer', 'activity', url: route('dashboard.wallet.payout.index', ['filter' => ['workspace_id' => Helper::activeWorkspaceId()], 'type' => 'transfer']));
            $menus[] = new MenuItem('Payouts', 'activity', url: route('dashboard.wallet.payout.index', ['filter' => ['workspace_id' => Helper::activeWorkspaceId()]]));
        }

        if ($user->hasPermissionTo(Permission::DEPOSIT_VIEW)) {
            $menus[] = new MenuItem('Deposits', 'activity', url: route('dashboard.wallet.deposit.index', ['filter' => ['workspace_id' => Helper::activeWorkspaceId()]]));
        }

        if ($user->hasAnyPermission([Permission::COMMODITY_TYPE_VIEW, Permission::ASSET_CLASS_VIEW, Permission::ASSET_TYPE_VIEW, Permission::FEE_VIEW, Permission::MASTER_ACCOUNT_VIEW, Permission::LEDGER_VIEW, Permission::EXCHANGE_RATE_VIEW])) {
            $menus[] = HttpHelper::getConfigRoute();
        }

        return $menus;
    }
}
