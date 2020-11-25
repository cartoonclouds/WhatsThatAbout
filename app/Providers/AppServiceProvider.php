<?php

namespace App\Providers;

use App\Contracts\Commentable;
use App\Http\Controllers\CommentController;
use App\Models\Image;
use App\Models\Page;
use App\Models\Scene;
use App\Models\User;
use App\Observers\ImageObserver;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Foundation\Application;
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
        Image::observe(ImageObserver::class);

        Paginator::defaultView('vendor.pagination.default');
    }
}
