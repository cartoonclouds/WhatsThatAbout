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
     * Determine whether the user can view any Comments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the Comment.
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
     * Determine whether the user can create Comments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->banned ? Response::deny('A comment cannot be created by a banned user') : Response::allow();
    }

    /**
     * Determine whether the user can update the Comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        if (
            (!$user->banned && $comment->commenter->is($user) && $comment->created_at->lessThan($comment->created_at->subHour()))
            || $user->hasAnyRole([User::ROLE_ADMIN, User::ROLE_MOD])
        ) {
            return Response::allow();
        }

        return Response::deny('A comment can only be edited by the commenter, a moderator or administrator');
    }

    /**
     * Determine whether the user can delete the Comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        if (
            (!$user->banned && $comment->commenter->is($user) && $comment->created_at->lessThan($comment->created_at->subHour()))
            || $user->hasAnyRole([User::ROLE_ADMIN, User::ROLE_MOD])
        ) {
            return Response::allow();
        }

        return Response::deny('A comment can only be deleted by the commenter, a moderator or administrator');
    }

    /**
     * Determine whether the user can restore the Comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function restore(User $user, Comment $comment)
    {
        if ($user->hasAnyRole([User::ROLE_ADMIN, User::ROLE_MOD])) {
            return Response::allow();
        }

        return Response::deny('A deleted comment can only be restored by a moderator or administrator');
    }

    /**
     * Determine whether the user can permanently delete the Comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function forceDelete(User $user, Comment $comment)
    {
        return Response::deny('A deleted comment can only be forced deleted by an administrator');
    }
}
