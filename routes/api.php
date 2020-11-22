<?php

use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\PageController;
use App\Http\Controllers\API\SegmentController;
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

    Route::apiResource('segments.comments', CommentController::class)
        ->shallow()
        ->parameters(['segments' => 'commentable'])
        ->scoped(['segments' => 'slug'])
        ->only(['store', 'update', 'destroy']);

    Route::apiResource('pages.votes', VoteController::class)
        ->shallow()
        ->parameters(['pages' => 'commentable'])
        ->scoped(['pages' => 'slug'])
        ->only(['store', 'update', 'destroy']);

    Route::apiResource('segments.votes', VoteController::class)
        ->shallow()
        ->parameters(['segments' => 'commentable'])
        ->scoped(['segments' => 'slug'])
        ->only(['store', 'update', 'destroy']);


    Route::post('pages/updateOrCreate/{page:slug?}', [PageController::class, 'updateOrCreate']);
    Route::delete('pages/{page:slug}', [PageController::class, 'destroy']);

    Route::post('segments/updateOrCreate/{segment:slug?}', [SegmentController::class, 'updateOrCreate']);
    Route::delete('segments/{segment:slug}', [SegmentController::class, 'destroy']);

});

