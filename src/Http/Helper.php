<?php

namespace Kanexy\LedgerFoundation\Http;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Menu\MenuItem;
use Kanexy\LedgerFoundation\Enums\Permission;
use Kanexy\LedgerFoundation\Services\StellerService;

class Helper
{
    public static function paginate($items, $perPage = 7, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path' => request()->url()]);
    }

    public static function redirectionOnDelete($count, $url, $message)
    {
        if($count > 1)
            return redirect()->back()->with($message);
        else
            return redirect($url)->with($message);
    }

    public static function getConfigRoute()
    {
        /** @var $user App\Model\User */
        $user = Auth::user();

        if ($user->hasPermissionTo(Permission::COMMODITY_TYPE_VIEW)) {
            return new MenuItem('Configuration', 'activity', url: route('dashboard.wallet.commodity-type.index'));
        } elseif ($user->hasPermissionTo(Permission::ASSET_CLASS_VIEW)) {
            return new MenuItem('Configuration', 'activity', url: route('dashboard.wallet.asset-class.index'));
        } elseif ($user->hasPermissionTo(Permission::ASSET_TYPE_VIEW)) {
            return new MenuItem('Configuration', 'activity', url: route('dashboard.wallet.asset-type.index'));
        } elseif ($user->hasPermissionTo(Permission::FEE_VIEW)) {
            return new MenuItem('Configuration', 'activity', url: route('dashboard.wallet.fee.index'));
        } elseif ($user->hasPermissionTo(Permission::MASTER_ACCOUNT_VIEW)) {
            return new MenuItem('Configuration', 'activity', url: route('dashboard.wallet.master-account.index'));
        } elseif ($user->hasPermissionTo(Permission::LEDGER_VIEW)) {
            return new MenuItem('Configuration', 'activity', url: route('dashboard.wallet.ledger.index'));
        } elseif ($user->hasPermissionTo(Permission::EXCHANGE_RATE_VIEW)) {
            return new MenuItem('Configuration', 'activity', url: route('dashboard.wallet.exchange-rate.index'));
        }
    }

    public  static function getStellarExchangeRate($info)
    {
        $stellerService = new StellerService();
        $details = $stellerService->getExchangeRate($info);

        return $details;
       
    }
}
