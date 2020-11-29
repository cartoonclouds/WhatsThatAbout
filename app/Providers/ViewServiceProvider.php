<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Genre;
use App\Models\Theme;
use App\Models\Format;
use Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('allRoles', collect([
            User::ROLE_SUPER_ADMIN,
            User::ROLE_ADMIN,
            User::ROLE_MOD
        ]));

        View::share('adminRoles', collect([
            User::ROLE_SUPER_ADMIN,
            User::ROLE_ADMIN
        ]));

        if (Schema::hasTable('genres')) {
            View::share('genres', Genre::exists() ? Genre::get()->map->only(['name', 'url']) : collect());
        }

        if (Schema::hastable('formats')) {
            View::share('formats', Format::get()->map->only(['name', 'url']));
        }

        if (Schema::hastable('themes')) {
            View::share('themes', Theme::get()->map->only(['name', 'url']));
        }

    }
}
