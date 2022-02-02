<?php

namespace Kanexy\LedgerFoundation\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Kanexy\LedgerFoundation\Http\Enums\Permission;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;

class DepositPolicy
{
    use HandlesAuthorization;

    public const VIEW = 'view';

    public const SHOW = 'show';

    public const CREATE = 'create';

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
        if ($user->hasPermissionTo(Permission::DEPOSIT_VIEW)) {
            return true;
        }

        if (! request()->has('filter.workspace_id')) {
            return false;
        }

        $workspaceId = request()->input('filter.workspace_id');

        return $user->workspaces()->where('workspace_id', $workspaceId)->exists();
    }

    public function create(User $user)
    {

        $workspaceId = request()->input('workspace_id', request()->input('filter.workspace_id'));

        if (empty($workspaceId)) {
            return false;
        }

        $workspace = Workspace::findOrFail($workspaceId);

        if ($workspace->users()->where('user_id', $user->id)->exists()) {
            return true;
        }

        return $user->hasPermissionTo(Permission::DEPOSIT_CREATE);

    }

    public function SHOW(User $user)
    {
        if ($user->hasPermissionTo(Permission::DEPOSIT_SHOW)) {
            return true;
        }

        if (! request()->has('filter.workspace_id')) {
            return false;
        }

        $workspaceId = request()->input('filter.workspace_id');

        return $user->workspaces()->where('workspace_id', $workspaceId)->exists();
    }
}
