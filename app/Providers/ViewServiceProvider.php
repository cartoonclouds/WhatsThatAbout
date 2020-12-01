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
        View::composer('*', function (\Illuminate\View\View $view) {

            $view->with('genres', Genre::get()->map->only(['name', 'url']));

            $view->with('formats', Format::get()->map->only(['name', 'url']));

            $view->with('themes', Theme::get()->map->only(['name', 'url']));
        });
    }
}
