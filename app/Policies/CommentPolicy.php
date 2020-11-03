<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommentPolicy
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
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function view(?User $user, Comment $comment)
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
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        if (
            ($comment->creator->is($user) && $comment->created_at->lessThan($comment->created_at->subHour()))
            || $user->hasAnyRole(['super-admin', 'admin', 'moderator'])
        ) {
            return Response::allow();
        }

        return Response::deny('A comment can only be edited by it\'s creator, a moderator or administrator');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        if (
            ($comment->creator->is($user) && $comment->created_at->lessThan($comment->created_at->subHour()))
            || $user->hasAnyRole(['super-admin', 'admin', 'moderator'])
        ) {
            return Response::allow();
        }

        return Response::deny('A comment can only be deleted by it\'s creator, a moderator or administrator');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function restore(User $user, Comment $comment)
    {
        if ($user->hasAnyRole(['super-admin', 'admin', 'moderator'])) {
            return Response::allow();
        }

        return Response::deny('A deleted comment can only be restored by a moderator or administrator');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function forceDelete(User $user, Comment $comment)
    {
        if ($user->hasAnyRole(['super-admin', 'admin'])) {
            return Response::allow();
        }

        return Response::deny('A deleted comment can only be forced deleted by an administrator');
    }
}
