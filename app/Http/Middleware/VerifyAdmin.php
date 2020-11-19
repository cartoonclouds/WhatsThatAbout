<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Role;

class VerifyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hasAnyRole([User::ROLE_MOD, User::ROLE_ADMIN, User::ROLE_SUPER_ADMIN])) {
            return $next($request);
        }

        return redirect(RouteServiceProvider::HOME)->withException(UnauthorizedException::forRoles([
            Role::findByName(User::ROLE_MOD),
            Role::findByName(User::ROLE_ADMIN),
            Role::findByName(User::ROLE_SUPER_ADMIN),
        ]));
    }
}
