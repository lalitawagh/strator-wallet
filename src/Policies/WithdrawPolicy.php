<?php

namespace Kanexy\LedgerFoundation\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Kanexy\LedgerFoundation\Enums\Permission;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;

class WithdrawPolicy
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
        if ($user->hasPermissionTo(Permission::WITHDRAW_VIEW)) {
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
        
        return $user->hasPermissionTo(Permission::WITHDRAW_CREATE);

    }

    public function show(User $user)
    {
        if ($user->hasPermissionTo(Permission::WITHDRAW_SHOW)) {
            return true;
        }

        if (! request()->has('filter.workspace_id')) {
            return false;
        }

        $workspaceId = request()->input('filter.workspace_id');

        return $user->workspaces()->where('workspace_id', $workspaceId)->exists();
    }
}
