<?php

namespace Kanexy\LedgerFoundation\Menu;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Menu\Contracts\Item;
use Kanexy\Cms\Menu\MenuItem;
use Kanexy\PartnerFoundation\Core\Helper;

class WalletDashboardMenuItem extends Item
{
    public int $priority = 101;

    protected string $label = 'Dashboard';

    protected string $icon = 'home';

    public function getIsVisible(): bool
    {
        /** @var $user App\Model\User */
        $user = Auth::user();

        if(!$user->is_banking_user)
        {
            return true;
        }
        return false;
    }

    public function getUrl(): string
    {
        return route('dashboard.wallet.wallet-dashboard');
    }
}
