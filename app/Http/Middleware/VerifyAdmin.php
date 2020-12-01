<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class VerifyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user && !$request->user->hasAnyRole([User::ROLE_MOD, User::ROLE_ADMIN, User::ROLE_SUPER_ADMIN])) {
            throw UnauthorizedException::forRoles([
                User::ROLE_MOD,
                User::ROLE_ADMIN,
                User::ROLE_SUPER_ADMIN,
            ]);
        }

        return $next($request);
    }
}
