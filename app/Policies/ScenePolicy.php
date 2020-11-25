<?php

namespace App\Policies;

use App\Models\Scene;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ScenePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any Scenes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the Scene.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Scene  $scene
     * @return mixed
     */
    public function view(?User $user, Scene $scene)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create Scenes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasAnyRole([User::ROLE_ADMIN, User::ROLE_MOD])) {
            return Response::allow();
        }

        return Response::deny('A scene can only be created by a moderator or administrator');
    }

    /**
     * Determine whether the user can update the Scene.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Scene  $scene
     * @return mixed
     */
    public function update(User $user, Scene $scene)
    {
        if ($scene->creator->is($user) || $user->hasRole(User::ROLE_ADMIN)) {
            return Response::allow();
        }

        return Response::deny('A scene can only be edited by a moderator or administrator');
    }

    /**
     * Determine whether the user can delete the Scene.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Scene  $scene
     * @return mixed
     */
    public function delete(User $user, Scene $scene)
    {
        if ($scene->creator->is($user) || $user->hasRole(User::ROLE_ADMIN)) {
            return Response::allow();
        }

        return Response::deny('A scene can only be deleted by a moderator or administrator');
    }

    /**
     * Determine whether the user can restore the Scene.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Scene $scene
     * @return mixed
     */
    public function restore(User $user, Scene $scene)
    {
        if ($user->hasRole(User::ROLE_ADMIN)) {
            return Response::allow();
        }

        return Response::deny('A deleted scene can only be restored by an administrator');
    }

    /**
     * Determine whether the user can permanently delete the Scene.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Scene $scene
     * @return mixed
     */
    public function forceDelete(User $user, Scene $scene)
    {
        return Response::deny('A deleted scene can only be force deleted by a super administrator');
    }
}
