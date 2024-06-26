<?php

namespace Kanexy\LedgerFoundation\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Kanexy\LedgerFoundation\Enums\Permission;

class AssetTypePolicy
{
    use HandlesAuthorization;

    public const VIEW = 'view';

    public const CREATE = 'create';

    public const EDIT = 'edit';

    public const DELETE = 'delete';

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user)
    {
        return $user->hasPermissionTo(Permission::ASSET_TYPE_VIEW);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::ASSET_TYPE_CREATE);
    }

    public function edit(User $user)
    {
        return $user->hasPermissionTo(Permission::ASSET_TYPE_EDIT);
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo(Permission::ASSET_TYPE_DELETE);
    }
}
