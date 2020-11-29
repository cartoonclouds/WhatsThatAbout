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
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\PageViewController;
use App\Http\Controllers\SceneViewController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
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

Route::get('/{page:slug}', PageViewController::class);

Route::get('scene/{scene:slug}', SceneViewController::class);

Route::resource('theme', ThemeController::class)->only(['index', 'show']);

Route::resource('format', FormatController::class)->only(['index', 'show']);

Route::resource('genre', GenreController::class)->only(['index', 'show']);


Route::group(['middleware' => ['auth']], function () {

    Route::resource('user', UserController::class)->only(['show', 'edit']);

    Route::group(['middleware' => ['auth.admin'], 'prefix' => 'admin/'], function () {

        Route::resource('users', AdminUserController::class)->only(['index', 'edit']);

        Route::resource('pages', AdminPageController::class)->only(['index', 'create', 'edit']);
        Route::post('pages/updateOrStore/{page:slug?}', [AdminPageController::class, 'updateOrStore']);

        Route::resource('scenes', AdminSceneController::class)->only(['index', 'create', 'edit']);
        Route::post('scenes/updateOrStore/{scene:slug?}', [AdminSceneController::class, 'updateOrStore']);

        Route::resource('themes', AdminThemeController::class)->only(['index', 'create', 'edit']);

        Route::resource('genres', AdminGenreController::class)->only(['index', 'create', 'edit']);

        Route::resource('formats', AdminFormatController::class)->only(['index', 'create', 'edit']);

    });

});

//Route::resource('pages.comments', CommentController::class)->parameters([
//    'pages' => 'commentable'
//])->only('show');
