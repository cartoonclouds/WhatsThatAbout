<?php

namespace App\Providers;

use App\Contracts\Commentable;
use App\Http\Controllers\CommentController;
use App\Models\Image;
use App\Models\Page;
use App\Models\Segment;
use App\Models\User;
use App\Observers\ImageObserver;
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
//        $this->app->bind(Commentable::class, function (Application $app) {
//            return Page::find(1);//Page::whereSlug(request()->segment(1))->first();
//        });

        Route::bind('commentable', function ($modelKey, \Illuminate\Routing\Route $route) {
            $modelClass = 'App\\Models\\' . ucfirst(rtrim(request()->segment(1), 's'));

            return $modelClass::findOrFail($modelKey);
        });

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
