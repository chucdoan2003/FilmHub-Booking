<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ShiftController;
use App\Http\Controllers\api\ApiShowtimes;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\api\ApiRowController;
use App\Http\Controllers\api\ApiSeatController;
use App\Http\Controllers\api\ApiTypeController;
use App\Http\Controllers\api\ApiCheckBookedSeat;

use App\Http\Controllers\api\MovieController;
use App\Http\Controllers\api\ComboController;
use Illuminate\Http\Request;

use App\Http\Controllers\VourchersController;

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

use App\Http\Controllers\api\TheaterController;
use App\Http\Controllers\RoomController;


Route::prefix('theaters')->group(function () {
    Route::get('/', [TheaterController::class, 'index']);
    Route::post('/', [TheaterController::class, 'store']);
    Route::get('/{theater}', [TheaterController::class, 'show']);
    Route::put('/{theater}', [TheaterController::class, 'update']);
    Route::delete('/{theater}', [TheaterController::class, 'destroy']);


    // Route::prefix('/{theater}/shifts')->group(function () {
    //     Route::get('/', [ShiftController::class, 'index']);
    //     Route::post('/', [ShiftController::class, 'store']);
    //     Route::get('/{shift}', [ShiftController::class, 'show']);
    //     Route::put('/{shift}', [ShiftController::class, 'update']);
    //     Route::delete('/{shift}', [ShiftController::class, 'destroy']);
    // });

    // Route::prefix('/{theater}/rooms')->group(function () {
    //     Route::get('/', [RoomController::class, 'index']);
    //     Route::post('/', [RoomController::class, 'store']);
    //     Route::get('/{room}', [RoomController::class, 'show']);
    //     Route::put('/{room}', [RoomController::class, 'update']);
    //     Route::delete('/{room}', [RoomController::class, 'destroy']);
    // });
});
Route::post('auth/login', [AuthController::class, 'login' ]);
Route::get('auth/profile', [AuthController::class, 'profile' ]);
Route::post('auth/logout', [AuthController::class, 'logout' ]);
Route::post('auth/register', [AuthController::class, 'register' ]);
Route::get('showtime/{id}', [ApiShowtimes::class, 'showtime' ])->name('showtime');

Route::apiResource('shifts', ShiftController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('seat', ApiSeatController::class);
Route::resource('row', ApiRowController::class);
Route::resource('type', ApiTypeController::class);


// Check ghe da dat
Route::get('/showtimes', [ApiCheckBookedSeat::class, 'index']);
Route::get('/showtimes/{showtimeId}', [ApiCheckBookedSeat::class, 'show']);



Route::apiResource('combos', ComboController::class);

Route::get('user/vourchers/{id}',[VourchersController::class, 'userVourchers'])->name('userVourchers');

Route::get('vourchers',[VourchersController::class, 'index'])->name('vourchers');

Route::get('vourcher/{mavoucher}',[VourchersController::class, 'getma'])->name('vourcher');
Route::get('vourcher/appma/{price}/{vourcher_price}',[VourchersController::class, 'appma'])->name('appma');
Route::get('user/vourcher/add/{vourcher}/{id_user}', [VourchersController::class, 'addVourcherUser'])->name('addVourcherUser');

use App\Http\Controllers\Api\PaymentController;

Route::post('/vnpay/payment', [PaymentController::class, 'vnpay_payment']);
Route::get('/vnpay/payment-return', [PaymentController::class, 'vnpay_payment_return'])->name('api.vnpay.return');

Route::resource('/movies', MovieController::class );

use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\DrinkController;
use App\Http\Controllers\api\FoodController;

Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments', [CommentController::class, 'store']);

Route::resource('drinks', DrinkController::class);
Route::resource('foods', FoodController::class);

