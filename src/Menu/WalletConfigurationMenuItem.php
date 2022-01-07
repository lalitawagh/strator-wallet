<?php

namespace Kanexy\LedgerFoundation\Menu;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Menu\Contracts\Item;
use Kanexy\Cms\Menu\MenuItem;

class WalletConfigurationMenuItem extends Item
{
    protected string $label = 'Wallet Settings';

    protected string $icon = 'tool';

    public int $priority = 1502;

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
            new MenuItem('Ledgers', 'activity',  url: route('dashboard.ledger-foundation.ledger.index')),
            new MenuItem('Config Fields', 'activity', url: route('dashboard.ledger-foundation.asset-type.index')),
            new MenuItem('Notifications', 'activity'),
            new MenuItem('Fees', 'activity'),
            new MenuItem('Payment Methods', 'activity'),
        ];
    }
}
