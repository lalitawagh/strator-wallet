<?php

namespace Kanexy\LedgerFoundation\Menu;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Menu\Contracts\Item;
use Kanexy\Cms\Menu\MenuItem;

class WalletMenuItem extends Item
{
    protected string $label = 'Wallet';

    protected string $icon = 'cast';

    public int $priority = 1501;

    public function getIsVisible(): bool
    {
        /** @var $user App\Model\User */
        $user = Auth::user();

        if($user->isSubscriber()) {
            return false;
        }

        return true;
    }

    public function getSubmenu(): array
    {
        return [
            new MenuItem('Transactions', 'activity', url: route('dashboard.ledger-foundation.wallet-transaction.index')),
            new MenuItem('Payouts', 'activity', url: route('dashboard.ledger-foundation.wallet-payout.index')),
            new MenuItem('Request Payments', 'activity', url: route('dashboard.ledger-foundation.wallet-receive.index')),
            new MenuItem('Deposits', 'activity', url: route('dashboard.ledger-foundation.wallet-deposit.index')),
            new MenuItem('Withdraw', 'activity',url: route('dashboard.ledger-foundation.wallet-withdraw.index')),
            new MenuItem('Exchange', 'activity',url: route('dashboard.ledger-foundation.wallet-exchange.index')),
            new MenuItem('Transfers', 'activity'),
            new MenuItem('Disputes', 'activity',url: route('dashboard.ledger-foundation.dispute.index')),

        ];
    }
}
