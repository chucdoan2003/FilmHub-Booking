<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ClientBookingController extends Controller
{
    public function index($id, Request $request)
{
    $showtimes = DB::table('showtimes')
        ->join('rooms', 'showtimes.room_id', '=', 'rooms.room_id')
        ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id')
        ->join('theaters', 'showtimes.theater_id', '=', 'theaters.theater_id')
        ->where('showtimes.movie_id', $id)
        ->select('showtimes.showtime_id',DB::raw('DATE(showtimes.datetime) AS show_date'),
            'shifts.start_time', 'showtimes.normal_price', 'showtimes.vip_price', 'rooms.room_name as room_name', 'theaters.name as theater_name')
        ->orderBy('show_date', 'asc')
        ->get();

    // Group các showtime theo ngày
    $showtimesGroupedByDate = $showtimes->groupBy('show_date');

    // Xử lý ngày mặc định nếu không có ngày nào được chọn
    $selectedDate = $request->input('selected_date', null);

    // Nếu không có ngày chọn, hiển thị tất cả showtimes
    if ($selectedDate) {
        // Lọc showtimes cho ngày được chọn
        $selectedShowtimes = $showtimesGroupedByDate->get($selectedDate, collect());
    } else {
        // Hiển thị toàn bộ showtimes nếu không có ngày chọn
        $selectedShowtimes = $showtimes;
    }

    return view('frontend.layouts.booking.index', [
        'showtimesGroupedByDate' => $showtimesGroupedByDate,
        'selectedShowtimes' => $selectedShowtimes,
        'selectedDate' => $selectedDate,
        'movieId' => $id
    ]);
}


}
