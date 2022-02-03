<?php

namespace Kanexy\LedgerFoundation\Menu;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Menu\Contracts\Item;
use Kanexy\Cms\Menu\MenuItem;
use Kanexy\PartnerFoundation\Core\Helper;

class WalletMenuItem extends Item
{
    public int $priority = 1501;

    protected string $label = 'Wallet';

    protected string $icon = 'cast';

    public function getIsVisible(): bool
    {
        return true;
    }

    public function getSubmenu(): array
    {
        /** @var $user App\Model\User */
        $user = Auth::user();

        $menus = [
                new MenuItem('Transactions', 'activity', url: route('dashboard.ledger-foundation.wallet-transaction.index')),
                new MenuItem('Payouts', 'activity', url: route('dashboard.ledger-foundation.wallet-payout.index')),
                new MenuItem('Request Payments', 'activity', url: route('dashboard.ledger-foundation.wallet-receive.index')),
                new MenuItem('Deposits', 'activity', url: route('dashboard.ledger-foundation.wallet-deposit.index',['filter' => ['workspace_id' => Helper::activeWorkspaceId()]])),
                new MenuItem('Withdraw', 'activity',url: route('dashboard.ledger-foundation.wallet-withdraw.index')),
                new MenuItem('Exchange', 'activity',url: route('dashboard.ledger-foundation.wallet-exchange.index')),
                new MenuItem('Transfers', 'activity'),
                new MenuItem('Disputes', 'activity',url: route('dashboard.ledger-foundation.dispute.index')),
            ];

        if ($user->isSuperAdmin()) {
            $menus[]=new MenuItem('Configuration', 'activity', url: route('dashboard.ledger-foundation.ledger.index'));
        }

        return $menus;
    }
}
