<?php

use App\Http\Controllers\api\ComboController;
use App\Http\Controllers\api\DrinkController;
use App\Http\Controllers\api\FoodController;
use App\Http\Controllers\api\ShiftController;
use App\Http\Controllers\api\ShowtimeController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// Route::prefix('theaters')->group(function () {
//     Route::get('/', [TheaterController::class, 'index']);
//     Route::post('/', [TheaterController::class, 'store']);
//     Route::get('/{theater}', [TheaterController::class, 'show']);
//     Route::put('/{theater}', [TheaterController::class, 'update']);
//     Route::delete('/{theater}', [TheaterController::class, 'destroy']);


//     Route::prefix('/{theater}/shifts')->group(function () {
//         Route::get('/', [ShiftController::class, 'index']);
//         Route::post('/', [ShiftController::class, 'store']);
//         Route::get('/{shift}', [ShiftController::class, 'show']);
//         Route::put('/{shift}', [ShiftController::class, 'update']);
//         Route::delete('/{shift}', [ShiftController::class, 'destroy']);
//     });

//     Route::prefix('/{theater}/rooms')->group(function () {
//         Route::get('/', [RoomController::class, 'index']);
//         Route::post('/', [RoomController::class, 'store']);
//         Route::get('/{room}', [RoomController::class, 'show']);
//         Route::put('/{room}', [RoomController::class, 'update']);
//         Route::delete('/{room}', [RoomController::class, 'destroy']);
//     });
// });
Route::apiResource('shifts', ShiftController::class);
Route::apiResource('combos', ComboController::class);
Route::apiResource('foods', FoodController::class);
Route::apiResource('drinks', DrinkController::class);
