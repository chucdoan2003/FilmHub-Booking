<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminTheaterController;


use App\Http\Controllers\admin\ShowtimesController;

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\VourcherAdmminController;
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
Route::post('/vnpay_payment' ,[PaymentController::class,'vnpay_payment'])->name('vnpay_payment');;
Route::get('/vnpay-return', [PaymentController::class, 'vnpay_payment_return'])->name('vnpay.return');
Route::get('/confirmBooking', [PaymentController::class, 'confirmBooking'])->name('confirmBooking');


// Movie



// Showtimes (Huy)
use App\Http\Controllers\client\ClientBookingController;
Route::get('/booking/{id}', [ClientBookingController::class, 'index'])->name('booking.index');

use App\Http\Controllers\client\ContactController;
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// Đăng nhập, đăng ký ( Chúc)
use App\Http\Controllers\admin\AuthController;
Route::get("auth/login", [AuthController::class, 'getLogin'])->name('getLogin');
Route::get("auth/register", [AuthController::class, 'getRegister'])->name('getRegister');
Route::get("auth/forgotPassword", [AuthController::class, 'getForgotPassword'])->name('getForgotPassword');
Route::get("auth/changePassword/{email}", [AuthController::class, 'getChangePassword'])->name('getChangePassword');

Route::post("auth/login", [AuthController::class, "login"])->name('login');
Route::post("auth/register", [AuthController::class, "register"])->name('register');
Route::post("auth/forgotPassword", [AuthController::class, "forgotPassword"])->name('forgotPassword');
Route::post("auth/logout", [AuthController::class, "logout"])->name('logout');
Route::post('auth/changePassword', [AuthController::class, 'changePassword' ])
->name('changePassword');


// Đặt ghế ( Hướng)
Route::get('/showtime/{id}', [ClientBookingController::class, 'getSeatBooking'])->name('getSeatBooking');
Route::get('detailBooking/{id}', [ClientBookingController::class, 'detailBooking'])->name('detailBooking');
Route::post('/detailBooking/{id}', [ClientBookingController::class, 'detailBooking'])->name('detailBooking');

// Detail ( Khôi)
use App\Http\Controllers\client\MovieController as FrontendMovieController;
use App\Http\Controllers\VourchersController;

Route::get('/', [FrontendMovieController::class, 'index'])->name('movies.index');
Route::get('/show/{id}', [FrontendMovieController::class, 'detail'])->name('movies.detail');

//Đổi Vourcher
// Route để hiển thị danh sách mã giảm giá
Route::get('/redeem/index', [VourchersController::class, 'index'])->name('vouchers.index');

// Route để hiển thị form đổi mã giảm giá
Route::get('/redeem', [VourchersController::class, 'showForm'])->name('redeem.form');

// Route để xử lý việc đổi mã giảm giá
Route::post('/redeem', [VourchersController::class, 'redeem'])->name('redeem.submit');