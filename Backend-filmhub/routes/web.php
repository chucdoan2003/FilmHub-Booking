<?php

use App\Http\Controllers\admin\MovieController;
use App\Http\Controllers\Admin\ShowtimesController;
use App\Http\Controllers\Admin\UserController;
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
});

Route::get('demo', [ShowtimesController::class, "demo"]);

Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
Route::get('/movies/detail', [MovieController::class, 'show'])->name('movies.show');
