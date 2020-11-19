<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageViewController;
use App\Http\Controllers\SegmentViewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SegmentController as AdminSegmentController;
use App\Http\Controllers\Admin\GenreController as AdminGenreController;
use App\Http\Controllers\Admin\ThemeController as AdminThemeController;
use App\Http\Controllers\Admin\FormatController as AdminFormatController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('user', UserController::class)->only(['show', 'edit']);

    Route::group(['middleware' => ['auth.admin']], function () {

        Route::resource('users', AdminUserController::class)->only(['index']);

        Route::resource('pages', AdminPageController::class)->only(['index']);

        Route::resource('segments', AdminSegmentController::class)->only(['index']);

        Route::resource('themes', AdminThemeController::class)->only(['index', 'edit']);

        Route::resource('genres', AdminGenreController::class)->only(['index', 'edit']);

        Route::resource('formats', AdminFormatController::class)->only(['index', 'edit']);

    });

});

Route::get('/segments/{segment:slug}', SegmentViewController::class);

Route::get('/{page:slug}', PageViewController::class);

