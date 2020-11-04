<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth']);


Route::resource('pages', 'PageController',
    ['only' => ['index', 'create', 'show', 'edit']]);


Route::resources([
    'segments' => 'SegmentController',
    'comments' => 'CommentController',
    'users' => 'UserController',
]);

