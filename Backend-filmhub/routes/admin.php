<?php

use App\Http\Controllers\admin\AdminShiftController;
use App\Http\Controllers\admin\ShowtimeController;
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

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::prefix('admin/shifts')->group(function () {
    Route::get('/', [AdminShiftController::class, 'index'])->name('admin.shifts.index'); // Lấy danh sách tất cả shifts
    Route::get('/create', [AdminShiftController::class, 'create'])->name('admin.shifts.create'); // Tạo một shift mới
    Route::post('/', [AdminShiftController::class, 'store'])->name('admin.shifts.store'); // Lưu shift mới
    Route::get('/{shift_id}/edit', [AdminShiftController::class, 'edit'])->name('admin.shifts.edit'); // Chỉnh sửa một shift
    Route::put('/{shift_id}', [AdminShiftController::class, 'update'])->name('admin.shifts.update'); // Cập nhật một shift
    Route::delete('/{shift_id}', [AdminShiftController::class, 'destroy'])->name('admin.shifts.destroy'); // Xóa một shift
});

Route::prefix('admin/showtimes')->group(function () {
    Route::get('/', [ShowtimeController::class, 'index'])->name('admin.showtimes.index'); // Lấy danh sách tất cả showtimes
    Route::get('/create', [ShowtimeController::class, 'create'])->name('admin.showtimes.create'); // Tạo một showtime mới
    Route::post('/', [ShowtimeController::class, 'store'])->name('admin.showtimes.store'); // Lưu showtime mới
    Route::get('/{showtime_id}/edit', [ShowtimeController::class, 'edit'])->name('admin.showtimes.edit'); // Chỉnh sửa một showtime
    Route::put('/{showtime_id}', [ShowtimeController::class, 'update'])->name('admin.showtimes.update'); // Cập nhật một showtime
    Route::delete('/{showtime_id}', [ShowtimeController::class, 'destroy'])->name('admin.showtimes.destroy'); // Xóa một showtime
});
