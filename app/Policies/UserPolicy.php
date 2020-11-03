<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any Users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->hasAnyRole([User::ROLE_ADMIN, User::ROLE_MOD])) {
            return Response::allow();
        }

        return Response::deny('Users can only be viewed by a moderator or administrator');
    }

    /**
     * Determine whether the user can view the User.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        if ($user->hasAnyRole([User::ROLE_ADMIN, User::ROLE_MOD])) {
            return Response::allow();
        }

        return Response::deny('A user can only be viewed by a moderator or administrator');
    }

    /**
     * Determine whether the user can create Users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasAnyRole([User::ROLE_ADMIN])) {
            return Response::allow();
        }

        return Response::deny('A user can only be created by an administrator');
    }

    /**
     * Determine whether the user can update the User.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if ($model->creator->is($user) || $user->hasAnyRole([User::ROLE_ADMIN])) {
            return Response::allow();
        }

        return Response::deny('A user can only be edited by themselves or an administrator');
    }

    /**
     * Determine whether the user can delete the User.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return Response::deny('A user can only be deleted by a super administrator');
    }

    /**
     * Determine whether the user can restore the User.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        return Response::deny('A user can only be restored by a super administrator');
    }

    /**
     * Determine whether the user can permanently delete the User.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        return Response::deny('A user can only be restored by a super administrator');
    }
}
