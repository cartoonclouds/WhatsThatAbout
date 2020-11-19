<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageViewController;
use App\Http\Controllers\SegmentViewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
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

Route::get('/debug-datatables', function () {
    return DataTables::eloquent(User::query())->make(true);
});


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('user', UserController::class)->only(['show', 'edit']);

    Route::resource('users', AdminUserController::class)->only(['index']);

});

Route::get('/segments/{segment:slug}', SegmentViewController::class);

Route::get('/{page:slug}', PageViewController::class);

