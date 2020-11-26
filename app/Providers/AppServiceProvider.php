<?php

namespace App\Providers;

use App\Models\Image;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        /*
         * TO INSTALL Imagemagick (Nginx)
         *
         * sudo apt-get update && sudo apt-get install -y imagemagick php-imagick && sudo service php restart && sudo service nginx restart
         */


        /*
         *
            Missing image placeholder

                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: Image Cap" preserveAspectRatio="xMidYMid slice" role="img">
                    <title>Poster Placeholder</title>
                    <rect width="100%" height="100%" fill="#868e96"/>
                    <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Poster Placeholder</text>
                </svg>

         *
         */


//        $this->app->bind(Commentable::class, function (Application $app) {
//            return Page::whereSlug(request()->scene(1))->first();
//        });

        Route::bind('commentable', function ($modelKey, \Illuminate\Routing\Route $route) {
            $modelClass = 'App\\Models\\' . ucfirst(rtrim(request()->segment(2), 's'));

            return $modelClass::findOrFail($modelKey);
        });

        Route::bind('votable', function ($modelKey, \Illuminate\Routing\Route $route) {
            $modelClass = 'App\\Models\\' . ucfirst(rtrim(request()->segment(2), 's'));

            return $modelClass::findOrFail($modelKey);
        });

        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('vendor.pagination.default');
    }
}
