<?php

use App\Http\Controllers\admin\RowController;
use App\Http\Controllers\admin\SeatController;
use App\Http\Controllers\admin\TypeController;

use App\Http\Controllers\admin\ComboController;
use App\Http\Controllers\admin\DrinkController;
use App\Http\Controllers\admin\FoodController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\admin\ShowtimesController;
use App\Http\Controllers\admin\VourcherEventController;
use App\Http\Controllers\BookingController;

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\VourcherAdmminController;

use App\Http\Controllers\admin\AdminShiftController;
use App\Http\Controllers\admin\StatisticController;
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

Route::middleware(['admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('seats', SeatController::class);
    Route::resource('rows', RowController::class);
    Route::resource('types', TypeController::class);
    Route::get('rooms/{room_id}/seats', [SeatController::class, 'filterSeatByRoom'])->name('filterSeatByRoom');
    Route::post('createSeat/', [SeatController::class, 'createSeat'])->name('createSeat');
});


Route::prefix('admin/combos')->group(function () {
    Route::get('/', [ComboController::class, 'index'])->name('admin.combos.index'); // Lấy danh sách tất cả combos
    Route::get('/create', [ComboController::class, 'create'])->name('admin.combos.create'); // Tạo một combo mới
    Route::post('/', [ComboController::class, 'store'])->name('admin.combos.store'); // Lưu combo mới
    Route::get('/{id}/edit', [ComboController::class, 'edit'])->name('admin.combos.edit'); // Chỉnh sửa một id
    Route::put('/{id}', [ComboController::class, 'update'])->name('admin.combos.update'); // Cập nhật một id
    Route::delete('/{id}', [ComboController::class, 'destroy'])->name('admin.combos.destroy'); // Xóa một id
});

Route::prefix('admin/foods')->group(function () {
    Route::get('/', [FoodController::class, 'index'])->name('admin.foods.index'); // Lấy danh sách tất cả món ăn
    Route::get('/create', [FoodController::class, 'create'])->name('admin.foods.create'); // Tạo một món ăn mới
    Route::post('/', [FoodController::class, 'store'])->name('admin.foods.store'); // Lưu món ăn mới
    Route::get('/{id}/edit', [FoodController::class, 'edit'])->name('admin.foods.edit'); // Chỉnh sửa một món ăn theo id
    Route::put('/{id}', [FoodController::class, 'update'])->name('admin.foods.update'); // Cập nhật một món ăn theo id
    Route::delete('/{id}', [FoodController::class, 'destroy'])->name('admin.foods.destroy'); // Xóa một món ăn theo id
});

// Routes cho Drink
Route::prefix('admin/drinks')->group(function () {
    Route::get('/', [DrinkController::class, 'index'])->name('admin.drinks.index'); // Lấy danh sách tất cả đồ uống
    Route::get('/create', [DrinkController::class, 'create'])->name('admin.drinks.create'); // Tạo một đồ uống mới
    Route::post('/', [DrinkController::class, 'store'])->name('admin.drinks.store'); // Lưu đồ uống mới
    Route::get('/{id}/edit', [DrinkController::class, 'edit'])->name('admin.drinks.edit'); // Chỉnh sửa một đồ uống theo id
    Route::put('/{id}', [DrinkController::class, 'update'])->name('admin.drinks.update'); // Cập nhật một đồ uống theo id
    Route::delete('/{id}', [DrinkController::class, 'destroy'])->name('admin.drinks.destroy'); // Xóa một đồ uống theo id
});

use App\Http\Controllers\admin\MovieController;
use App\Http\Controllers\admin\GenreController;
use App\Http\Controllers\admin\TicketController;
use App\Http\Controllers\admin\CommentController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/movies', MovieController::class);
    Route::resource('/genres', GenreController::class);
    Route::resource('/tickets', TicketController::class);
    Route::get('/comments', [CommentController::class, 'showComments'])->name('comments.index');
    Route::delete('/comments/{id}', [CommentController::class, 'deleteComment'])->name('comments.delete');
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


// Route::prefix("admin")->group(function(){
//     // Route::resource("users", UserController::class);
//     Route::get('booking/list', [BookingController::class, 'index'])->name('bookings.index');
//     Route::get('bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
//     Route::post('/book-tickets', [BookingController::class, 'purchaseTicket'])->name('purchase.ticket');


// });



Route::prefix("admin")->group(function(){
    Route::resource("users", UserController::class);
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

    Route::resource('vourchers', VourcherAdmminController::class);
});


Route::prefix("admin")->group(function(){
    // Route::resource("users", UserController::class);
    Route::get('booking/list', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/book-tickets', [BookingController::class, 'purchaseTicket'])->name('purchase.ticket');
});

Route::get('/admin/tickets/{ticket}/qr', [TicketController::class, 'showQr'])->name('admin.tickets.qr');
Route::get('admin/tickets/{ticket}/print', [TicketController::class, 'printTicket'])->name('admin.tickets.print');

Route::prefix('admin/statistics')->group(function () {
    Route::get('/film', [StatisticController::class, 'statisticFilm'])->name('admin.statistics.statisticFilm');
    Route::get('/filmHub', [StatisticController::class, 'statisticFilmHub'])->name('admin.statistics.statisticFilmHub');
    Route::get('/theater/{theater_id}', [StatisticController::class, 'statisticTheater'])->name('admin.statistics.statisticTheater');
    Route::get('/statistics/filmTheater/{theater_id}/{movie_id}', [StatisticController::class, 'statisticFilmTheater'])->name('admin.statistics.statisticFilmTheater');
    Route::get('/statistics/film-hub/data', [StatisticController::class, 'statisticFilmHubData'])->name('admin.statistics.statisticFilmHubData');
    Route::get('/statistics/theater/data', [StatisticController::class, 'statisticTheaterData'])->name('admin.statistics.statisticTheaterData');

});


use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\CategoryController;
Route::prefix("admin")->as('admin.')->group(function () {
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);
});


// vourcher_event
Route::prefix('admin/vourcher-events')->group(function () {
    Route::get('/', [VourcherEventController::class, 'index'])->name('vourcher-events.index'); // Lấy danh sách tất cả vourcher events
    Route::get('/create', [VourcherEventController::class, 'create'])->name('vourcher-events.create'); // Tạo một vourcher event mới
    Route::post('/', [VourcherEventController::class, 'store'])->name('vourcher-events.store'); // Lưu vourcher event mới
    Route::get('/{vourcher_event}/edit', [VourcherEventController::class, 'edit'])->name('vourcher-events.edit'); // Chỉnh sửa một vourcher event
    Route::put('/{vourcher_event}', [VourcherEventController::class, 'update'])->name('vourcher-events.update'); // Cập nhật một vourcher event
    Route::delete('/{vourcher_event}', [VourcherEventController::class, 'destroy'])->name('vourcher-events.destroy'); // Xóa một vourcher event
});


// banner
Route::prefix("admin")->group(function(){
    Route::get('banners', [BannerController::class,'index'])->name('banner.index');
    Route::get('banner/create', [BannerController::class,'create'])->name('banner.create');
    Route::post('banner/store', [BannerController::class,'store'])->name('banner.store');
    Route::get('banner/edit/{id}', [BannerController::class,'edit'])->name('banner.edit');
    Route::put('banner/update/{id}', [BannerController::class,'update'])->name('banner.update');
    Route::delete('banner/destroy/{id}', [BannerController::class,'destroy'])->name('banner.destroy');




});
