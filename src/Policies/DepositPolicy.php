<?php

namespace Kanexy\LedgerFoundation\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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
        if($user->isSubscriber())
        {
            return true;
        }

        return false;
    }

    public function create(User $user)
    {
        if($user->isSubscriber())
        {
            return true;
        }

        return false;
    }

    public function SHOW(User $user)
    {
        if($user->isSubscriber())
        {
            return true;
        }

        return false;
    }
}
