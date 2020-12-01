<?php

use App\Http\Controllers\Admin\FormatController as AdminFormatController;
use App\Http\Controllers\Admin\GenreController as AdminGenreController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SceneController as AdminSceneController;
use App\Http\Controllers\Admin\ThemeController as AdminThemeController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\FormatController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageViewController;
use App\Http\Controllers\SceneViewController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/{page:slug}', PageViewController::class)->name('pages');

Route::get('scenes/{scene:slug}', SceneViewController::class)->name('scenes');


Route::resources([
    'themes' => ThemeController::class,
    'formats' => FormatController::class,
    'genres' => GenreController::class
], [
    'only' => [ 'index', 'show' ]
]);


Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::resource('user', UserController::class)->only(['show', 'edit']);

    Route::group(['middleware' => ['auth.admin'], 'prefix' => 'admin/', 'as' => 'admin.'], function () {

        Route::resource('users', AdminUserController::class)->only(['index', 'edit']);

        Route::post('pages/store/{page:slug?}', [AdminPageController::class, 'updateOrCreate'])->name('pages.store');

        Route::post('scenes/store/{scene:slug?}', [AdminSceneController::class, 'updateOrCreate'])->name('scenes.store');

        Route::post('themes/store/{theme:slug?}', [AdminThemeController::class, 'updateOrCreate'])->name('themes.store');

        Route::post('genres/store/{genre:slug?}', [AdminGenreController::class, 'updateOrCreate'])->name('genres.store');

        Route::post('formats/store/{format:slug?}', [AdminFormatController::class, 'updateOrCreate'])->name('formats.store');

        Route::resources([
            'pages' => AdminPageController::class,
            'scenes' => AdminSceneController::class,
            'themes' => AdminThemeController::class,
            'genres' => AdminGenreController::class,
            'formats' => AdminFormatController::class,
        ], [
            'only' => ['index', 'create', 'edit']
        ]);

    });

});

//Route::resource('pages.comments', CommentController::class)->parameters([
//    'pages' => 'commentable'
//])->only('show');
