<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Showtime;
use Illuminate\Support\Facades\DB;
use Exception;

class ApiCheckBookedSeat extends Controller
{
    public function index()
    {
        try {
            $showtimes = Showtime::with(['movie', 'room', 'shift'])->get();
            $selectedSeats = [];

            $showtimesWithBookedSeats = $showtimes->map(function ($showtime) {
                $bookedSeats = DB::table('tickets_seats')
                                ->where('showtime_id', $showtime->showtime_id)
                                ->pluck('seat_id')
                                ->toArray();

                // Gắn thêm danh sách ghế đã đặt vào từng suất chiếu
                $showtime->booked_seats = $bookedSeats;
                return $showtime;
            });

            return response()->json([
                'success' => true,
                'message' => 'Lấy dữ liệu thành công',
                'showtimes' => $showtimesWithBookedSeats,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi lấy danh sách suất chiếu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($showtimeId)
    {
        try {
            $showtime = Showtime::with('movie', 'room.seats', 'shift')->where('showtime_id', $showtimeId)->firstOrFail();

            // Lấy danh sách ghế đã được đặt cho suất chiếu này từ bảng ticket_seat
            $bookedSeats = DB::table('tickets_seats')
                            ->where('showtime_id', $showtimeId)
                            ->pluck('seat_id')
                            ->toArray();

            return response()->json([
                'success' => true,
                'message' => 'Lấy dữ liệu thành công',
                'showtime' => $showtime,
                'bookedSeats' => $bookedSeats
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi lấy thông tin suất chiếu',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
