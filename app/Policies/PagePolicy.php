<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any Pages.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return Response::allow();
    }


    /**
     * Determine whether the user can view the Page.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Page $page
     * @return mixed
     */
    public function view(?User $user, Page $page)
    {
        return Response::allow();
    }


    /**
     * Determine whether the user can create Pages.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasRole(User::ROLE_ADMIN)) {
            return Response::allow();
        }

        return Response::deny('A page can only be created by an administrator');
    }


    /**
     * Determine whether the user can update the Page.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Page $page
     * @return mixed
     */
    public function update(User $user, Page $page)
    {
        if ($page->creator->is($user) || $user->hasRole(User::ROLE_ADMIN)) {
            return Response::allow();
        }

        return Response::deny('A page can only be edited by the creator or an administrator');
    }


    /**
     * Determine whether the user can delete the Page.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Page $page
     * @return mixed
     */
    public function delete(User $user, Page $page)
    {
        if ($page->creator->is($user) || $user->hasRole(User::ROLE_ADMIN)) {
            return Response::allow();
        }

        return Response::deny('A page can only be deleted by the creator or an administrator');
    }


    /**
     * Determine whether the user can restore the Page.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Page $page
     * @return mixed
     */
    public function restore(User $user, Page $page)
    {
        if ($page->creator->is($user) || $user->hasRole(User::ROLE_ADMIN)) {
            return Response::allow();
        }

        return Response::deny('A deleted page can only be restored by an administrator');
    }


    /**
     * Determine whether the user can permanently delete the Page.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Page $page
     * @return mixed
     */
    public function forceDelete(User $user, Page $page)
    {
        return Response::deny('A deleted page can only be force deleted by a super administrator');
    }

}
