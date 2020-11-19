<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any Votes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the Vote.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vote  $vote
     * @return mixed
     */
    public function view(?User $user, Vote $vote)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create Votes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->banned ? Response::deny('A vote cannot be created by a banned user') : Response::allow();
    }

    /**
     * Determine whether the user can update the Vote.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vote  $vote
     * @return mixed
     */
    public function update(User $user, Vote $vote)
    {
        return !$user->banned && $vote->voter->is($user) ? Response::allow() : Response::deny('A vote can only be edited by the voter');
    }

    /**
     * Determine whether the user can delete the Vote.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vote  $vote
     * @return mixed
     */
    public function delete(User $user, Vote $vote)
    {
        return !$user->banned && $vote->voter->is($user) ? Response::allow() : Response::deny('A vote can only be edited by the voter');
    }
}
