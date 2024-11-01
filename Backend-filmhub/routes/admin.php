<?php

use App\Http\Controllers\admin\AdminShiftController;
// use App\Http\Controllers\admin\TicketController;
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

// Route::prefix('admin/tickets')->group(function () {
//     Route::get('/', [TicketController::class, 'index'])->name('admin.tickets.index'); // Lấy danh sách tất cả shifts
//     Route::delete('/{id}', [TicketController::class, 'destroy'])->name('admin.tickets.destroy');
//     Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('admin.tickets.show');
//     // Route cho trang lọc vé
//     Route::get('/filter', [TicketController::class, 'filter'])->name('admin.tickets.filter');
//     Route::get('/get-seats', [TicketController::class, 'getSeatsByTicket'])->name('admin.tickets.get-seats');
// });
