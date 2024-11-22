<?php

use App\Http\Controllers\admin\GenreController;
use App\Http\Controllers\admin\MovieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('admin', function () {
    return view('admin.dashboard');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/movies', MovieController::class);
    Route::resource('/genres', GenreController::class);
});
