<?php

use App\Http\Controllers\admin\RowController;
use App\Http\Controllers\admin\SeatController;
use App\Http\Controllers\admin\TypeController;

use App\Http\Controllers\admin\ComboController;
use App\Http\Controllers\admin\DrinkController;
use App\Http\Controllers\admin\FoodController;
use App\Http\Controllers\Admin\ProductController;
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
    Route::resource('types', TypeController::class);
    Route::get('rooms/{room_id}/seats', [SeatController::class, 'filterSeatByRoom'])->name('filterSeatByRoom');
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
