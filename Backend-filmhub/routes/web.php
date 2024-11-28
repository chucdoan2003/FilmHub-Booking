<?php

use App\Http\Controllers\Admin\AdminTheaterController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\frontend\MovieController as FrontendMovieController;
use App\Http\Controllers\PaymentController;
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
    Route::resource('theaters', AdminTheaterController::class);
});

Route::get('/theaters/rooms', [AdminTheaterController::class, 'indexRoom'])->name('theaters.indexRoom');
Route::get('/theaters/rooms/create', [AdminTheaterController::class, 'createRoom'])->name('theaters.createRoom');
Route::post('/theaters/rooms', [AdminTheaterController::class, 'storeRoom'])->name('theaters.storeRoom');
Route::get('/theaters/rooms/{id}/edit', [AdminTheaterController::class, 'editRoom'])->name('theaters.editRoom');
Route::put('/theaters/rooms/{id}', [AdminTheaterController::class, 'updateRoom'])->name('theaters.updateRoom');

Route::delete('/theaters/rooms/{room}', [AdminTheaterController::class, 'destroyRoom'])->name('theaters.destroyRoom');



// Payment
Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay_payment');;
Route::get('/vnpay-return', [PaymentController::class, 'vnpay_payment_return'])->name('vnpay.return');



// Movie
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/movies', MovieController::class);
});



//========================================FrontEnd========================
Route::get('/', function () {
    return view('frontend.layouts.master');
});
Route::get('/showtime', function () {
    return view('frontend.showtime.index');
});
Route::prefix('frontend')->name('frontend.')->group(function () {
    Route::get('/', [FrontendMovieController::class, 'index'])->name('frontend.movies.index');
});
