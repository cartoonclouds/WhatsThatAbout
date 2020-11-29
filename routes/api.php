<?php

use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\Admin\API\FormatController as AdminAPIFormatController;
use App\Http\Controllers\Admin\API\ThemeController as AdminAPIThemeController;
use App\Http\Controllers\Admin\API\GenreController as AdminAPIGenreController;
use App\Http\Controllers\Admin\API\PageController as AdminAPIPageController;
use App\Http\Controllers\Admin\API\SceneController as AdminAPISceneController;
use App\Http\Controllers\API\VoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api']], function() {

    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::apiResource('pages.comments', CommentController::class)
        ->shallow()
        ->parameters(['pages' => 'commentable'])
        ->scoped(['pages' => 'slug'])
        ->only(['store', 'update', 'destroy']);

    Route::apiResource('scenes.comments', CommentController::class)
        ->shallow()
        ->parameters(['scenes' => 'commentable'])
        ->scoped(['scenes' => 'slug'])
        ->only(['store', 'update', 'destroy']);

    Route::apiResource('pages.votes', VoteController::class)
        ->shallow()
        ->parameters(['pages' => 'commentable'])
        ->scoped(['pages' => 'slug'])
        ->only(['store', 'update', 'destroy']);

    Route::apiResource('scenes.votes', VoteController::class)
        ->shallow()
        ->parameters(['scenes' => 'commentable'])
        ->scoped(['scenes' => 'slug'])
        ->only(['store', 'update', 'destroy']);


    Route::group(['middleware' => ['auth.admin'], 'prefix' => 'admin/'], function () {

        Route::delete('format/{format:slug}', [AdminAPIFormatController::class, 'destroy']);
        Route::delete('theme/{theme:slug}', [AdminAPIThemeController::class, 'destroy']);
        Route::delete('genre/{genre:slug}', [AdminAPIGenreController::class, 'destroy']);
        Route::delete('page/{page:slug}', [AdminAPIPageController::class, 'destroy']);
        Route::delete('scene/{scene:slug}', [AdminAPISceneController::class, 'destroy']);

    });
});

