<?php

use App\Http\Controllers\admin\GenreController;
use App\Http\Controllers\admin\MovieController;
use App\Http\Controllers\frontend\MovieController as FrontendMovieController;
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


//========================================FrontEnd========================
Route::get('/showtime', function () {
    return view('frontend.showtime.index');
});
    Route::get('/', [FrontendMovieController::class, 'index'])->name('movies.index');
    Route::get('/show/{id}', [FrontendMovieController::class, 'detail'])->name('movies.detail');
