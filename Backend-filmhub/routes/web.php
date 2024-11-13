<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminTheaterController;
use App\Http\Controllers\admin\MovieController;
use App\Http\Controllers\admin\ShowtimesController;
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



// Movie
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/movies', MovieController::class);
});



// Showtime
Route::prefix("admin")->group(function(){
    // Route::resource("users", UserController::class);
    Route::get('showtime/list', [ShowtimesController::class, "list"])->name('showtimes.index');
    Route::get('showtime/create', [ShowtimesController::class, "create"])->name('showtimes.create');
    Route::post('showtime/create2', [ShowtimesController::class, "create2"])->name('showtimes.store1'); // Route này xử lý việc tạo
    Route::post('showtime/store', [ShowtimesController::class, "store"])->name('showtimes.store2'); // Route này để gửi cuối cùng // hiển thị ca chiếu theo phòng, valid ca chiếu chọn r thì không chọn được nx
    Route::post('showtime/add', [ShowtimesController::class, "addshowtime"])->name('showtimes.addshowtime');// thêm xuất chiếu
    Route::get('showtime/edit/{id}', [ShowtimesController::class, "edit"])->name('showtimes.edit');
    Route::put('showtime/update/{id}', [ShowtimesController::class, "update"])->name('showtimes.update');
    Route::delete('showtime/destroy/{id}', [ShowtimesController::class, "destroy"])->name('showtimes.destroy');
    Route::post('showtime/getApi', [ShowtimesController::class, "getAPI"])->name('showtimes.getAPI');
});


Route::prefix("admin")->group(function(){
    // Route::resource("users", UserController::class);
    Route::get('booking/list', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/book-tickets', [BookingController::class, 'purchaseTicket'])->name('purchase.ticket');


});
