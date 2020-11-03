<?php

namespace App\Policies;

use App\Models\Segment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SegmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Segment  $segment
     * @return mixed
     */
    public function view(?User $user, Segment $segment)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasAnyRole(['super-admin', 'admin', 'moderator'])) {
            return Response::allow();
        }

        return Response::deny('A segment can only be created by a moderator or administrator');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Segment  $segment
     * @return mixed
     */
    public function update(User $user, Segment $segment)
    {
        if ($user->hasAnyRole(['super-admin', 'admin', 'moderator'])) {
            return Response::allow();
        }

        return Response::deny('A segment can only be edited by a moderator or administrator');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Segment  $segment
     * @return mixed
     */
    public function delete(User $user, Segment $segment)
    {
        if ($user->hasAnyRole(['super-admin', 'admin'])) {
            return Response::allow();
        }

        return Response::deny('A segment can only be deleted by an administrator');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Segment $segment
     * @return mixed
     */
    public function restore(User $user, Segment $segment)
    {
        if ($user->hasAnyRole(['super-admin', 'admin'])) {
            return Response::allow();
        }

        return Response::deny('A deleted segment can only be restored by an administrator');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Segment $segment
     * @return mixed
     */
    public function forceDelete(User $user, Segment $segment)
    {
        if ($user->hasRole(['super-admin'])) {
            return Response::allow();
        }

        return Response::deny('A deleted segment can only be force deleted by a super administrator');
    }
}
