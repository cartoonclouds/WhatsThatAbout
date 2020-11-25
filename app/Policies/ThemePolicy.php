<?php

namespace App\Policies;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ThemePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->hasRole(User::ROLE_ADMIN)) {
            return Response::allow();
        }

        return Response::deny('A user can only be created by an administrator');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Theme  $theme
     * @return mixed
     */
    public function view(User $user, Theme $theme)
    {
        if ($user->hasRole(User::ROLE_ADMIN)) {
            return Response::allow();
        }

        return Response::deny('A user can only be created by an administrator');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasRole(User::ROLE_ADMIN)) {
            return Response::allow();
        }

        return Response::deny('A user can only be created by an administrator');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Theme  $theme
     * @return mixed
     */
    public function update(User $user, Theme $theme)
    {
        if ($user->hasRole(User::ROLE_ADMIN)) {
            return Response::allow();
        }

        return Response::deny('A user can only be created by an administrator');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Theme  $theme
     * @return mixed
     */
    public function delete(User $user, Theme $theme)
    {
        if ($user->hasRole(User::ROLE_SUPER_ADMIN)) {
            return Response::allow();
        }

        return Response::deny('A user can only be created by a super administrator');
    }
}
