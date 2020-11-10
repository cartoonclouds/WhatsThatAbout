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

    Route::apiResource('page.comment', CommentController::class)
        ->shallow()
        ->scoped(['page' => 'slug'])
        ->except(['index', 'show']);

    Route::apiResource('segment.comment', CommentController::class)
        ->shallow()
        ->scoped(['segment' => 'slug'])
        ->except(['index', 'show']);

    Route::apiResource('page.vote', VoteController::class)
        ->shallow()
        ->scoped(['page' => 'slug'])
        ->except(['index', 'show']);

    Route::apiResource('segment.vote', VoteController::class)
        ->shallow()
        ->scoped(['segment' => 'slug'])
        ->except(['index', 'show']);


    Route::post('pages/updateOrCreate/{page:slug?}', [PageController::class, 'updateOrCreate']);
    Route::delete('pages/{page:slug}', [PageController::class, 'destroy']);

    Route::post('segments/updateOrCreate/{segment:slug?}', [SegmentController::class, 'updateOrCreate']);
    Route::delete('segments/{segment:slug}', [SegmentController::class, 'destroy']);

});

