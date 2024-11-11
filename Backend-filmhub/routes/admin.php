<?php

use App\Http\Controllers\admin\RowController;
use App\Http\Controllers\admin\SeatController;
use App\Http\Controllers\admin\TypeController;
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
