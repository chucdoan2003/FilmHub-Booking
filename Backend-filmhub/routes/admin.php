<?php

use App\Http\Controllers\admin\AdminShiftController;
use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\admin\RowController;
use App\Http\Controllers\admin\SeatController;
use App\Http\Controllers\Admin\ShowtimesController;
use App\Http\Controllers\admin\StatisticController;
use App\Http\Controllers\admin\TypeController;
use App\Http\Controllers\BookingController;
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

Route::prefix('admin')->as('admin.')->group(function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('seats', SeatController::class);
    Route::resource('rows', RowController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('types', TypeController::class);
    Route::get('rooms/{room_id}/seats', [SeatController::class, 'filterSeatByRoom'])->name('filterSeatByRoom');
});

Route::prefix('admin/shifts')->group(function () {
    Route::get('/', [AdminShiftController::class, 'index'])->name('admin.shifts.index'); // Lấy danh sách tất cả shifts
    Route::get('/create', [AdminShiftController::class, 'create'])->name('admin.shifts.create'); // Tạo một shift mới
    Route::post('/', [AdminShiftController::class, 'store'])->name('admin.shifts.store'); // Lưu shift mới
    Route::get('/{shift_id}/edit', [AdminShiftController::class, 'edit'])->name('admin.shifts.edit'); // Chỉnh sửa một shift
    Route::put('/{shift_id}', [AdminShiftController::class, 'update'])->name('admin.shifts.update'); // Cập nhật một shift
    Route::delete('/{shift_id}', [AdminShiftController::class, 'destroy'])->name('admin.shifts.destroy'); // Xóa một shift
});

Route::prefix('admin/shifts')->group(function () {
    Route::get('/statistics', [StatisticController::class, 'index'])->name('admin.statistics.index');
    Route::post('/statistics', [StatisticController::class, 'show'])->name('admin.statistics.show');
});

Route::prefix("admin")->group(function(){
    // Route::resource("users", UserController::class);
    Route::get('showtime/list', [ShowtimesController::class, "list"])->name('showtimes.index');
    Route::get('showtime/create', [ShowtimesController::class, "create"])->name('showtimes.create');// hiển thị giao diện thêm ngày
    Route::post('showtime/create2', [ShowtimesController::class, "create2"])->name('showtimes.store1'); // hiển thị movie và room trong theo ngày valid room nếu full ca
    Route::post('showtime/store', [ShowtimesController::class, "store"])->name('showtimes.store2');// hiển thị ca chiếu theo phòng, valid ca chiếu chọn r thì không chọn được nx
    Route::post('showtime/add', [ShowtimesController::class, "addshowtime"])->name('showtimes.addshowtime');// thêm xuất chiếu
    Route::get('showtime/edit/{id}', [ShowtimesController::class, "edit"])->name('showtimes.edit');
    Route::put('showtime/update/{id}', [ShowtimesController::class, "update"])->name('showtimes.update');
    Route::delete('showtime/destroy/{id}', [ShowtimesController::class, "destroy"])->name('showtimes.destroy');
    Route::post('showtime/getApi', [ShowtimesController::class, "getAPI"])->name('showtimes.getAPI');
    Route::get('/get-rooms-by-theater', [ShowtimesController::class, 'getRoomsByTheater'])->name('getRoomsByTheater');

    // Route::resource('vourchers', VourcherAdmminController::class);
});
Route::prefix("admin")->group(function(){
    // Route::resource("users", UserController::class);
    Route::get('booking/list', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/book-tickets', [BookingController::class, 'purchaseTicket'])->name('purchase.ticket');


});