<?php

namespace Riteserve\LedgerFoundation\Menu;

use Illuminate\Support\Facades\Auth;
use Riteserve\Cms\Menu\Contracts\Item;
use Riteserve\Cms\Menu\MenuItem;

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
            new MenuItem('Ledgers', 'activity',  url: route('dashboard.ledger.index')),
            new MenuItem('Asset Type', 'activity', url: route('dashboard.asset-type.index')),
            new MenuItem('Asset Class', 'activity', url: route('dashboard.ledger-foundation.asset-class.index')),
            new MenuItem('Commodity Type', 'activity', url: route('dashboard.commodity-type.index')),
            new MenuItem('Notifications', 'activity'),
            new MenuItem('Fees', 'activity'),
            new MenuItem('Payment Methods', 'activity'),
        ];
    }
}
