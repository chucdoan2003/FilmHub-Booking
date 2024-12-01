<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
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
public function getSeatBooking($showtime_id){
    $showtime = Showtime::with([
        'movies', 
        'rooms.rows.seats', // Tải trước hàng và ghế
        'rooms.theaters', 
        'shifts'
    ])
    ->where('showtime_id', $showtime_id)
    ->firstOrFail();
     // Lấy giá vé
    $normalPrice = $showtime->normal_price;
    $vipPrice = $showtime->vip_price;
    return view('frontend.layouts.booking.getSeatBooking', compact('showtime', 'normalPrice', 'vipPrice'));
}
public function detailBooking(Request $request ,$showtime_id){
    $showtime = Showtime::findOrFail($showtime_id); // Lấy thông tin showtime

    // Nhận ghế đã chọn từ request
    $selectedSeats = $request->input('selected_seats'); // Có thể là chuỗi
    $totalPrice = $request->input('total_price'); // Tổng giá tiền

    // Nếu $selectedSeats là chuỗi, bạn có thể chuyển nó thành mảng
    if (is_string($selectedSeats)) {
        $selectedSeatsArray = explode(', ', $selectedSeats); // Chuyển đổi chuỗi thành mảng
    } else {
        $selectedSeatsArray = $selectedSeats; // Nếu đã là mảng
    }

    // Truyền dữ liệu đến view
    return view('frontend.layouts.booking.detailBooking', compact(
        'showtime',
        'selectedSeatsArray', // Truyền mảng ghế đã chọn
        'totalPrice'
    ));

}
}
