<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageViewController;
use App\Http\Controllers\SegmentViewController;
use App\Http\Controllers\UserController;
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


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/{page:slug}', PageViewController::class);

Route::get('/segments/{segment:slug}', SegmentViewController::class);

Route::group(['middleware' => ['auth']], function () {

    Route::resource('user', UserController::class)->only(['show', 'edit']);

});
