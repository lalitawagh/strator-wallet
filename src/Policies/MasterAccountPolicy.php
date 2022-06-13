<?php

namespace Kanexy\LedgerFoundation\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Kanexy\LedgerFoundation\Enums\Permission;

class MasterAccountPolicy
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
        return $user->hasPermissionTo(Permission::MASTER_ACCOUNT_VIEW);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::MASTER_ACCOUNT_CREATE);
    }

    public function edit(User $user)
    {
        return $user->hasPermissionTo(Permission::MASTER_ACCOUNT_EDIT);
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo(Permission::MASTER_ACCOUNT_DELETE);
    }
}
