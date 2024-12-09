<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Showtime;
use Illuminate\Support\Facades\Auth;
use App\Models\Seat;
use App\Models\Genre;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use App\Models\Combo;
class ClientBookingController extends Controller
{
    public function index($id, Request $request)
    {
        $showtimes = DB::table('showtimes')
            ->join('rooms', 'showtimes.room_id', '=', 'rooms.room_id')
            ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id')
            ->join('theaters', 'showtimes.theater_id', '=', 'theaters.theater_id')
            ->where('showtimes.movie_id', $id)
            ->select(
                'showtimes.showtime_id',
                DB::raw('DATE(showtimes.datetime) AS show_date'),
                'shifts.start_time',
                'showtimes.normal_price',
                'showtimes.vip_price',
                'rooms.room_name as room_name',
                'theaters.name as theater_name'
            )
            ->orderBy('show_date', 'asc')
            ->orderBy('shifts.start_time', 'asc')
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
        $genres = Genre::withCount('movies')->get();

        return view('frontend.layouts.booking.index', [
            'showtimesGroupedByDate' => $showtimesGroupedByDate,
            'selectedShowtimes' => $selectedShowtimes,
            'selectedDate' => $selectedDate,
            'movieId' => $id,
            'genres' => $genres
        ]);
    }


    public function getSeatBooking($showtime_id)
    {


        $showtime = Showtime::with([
            'movies',
            'rooms.rows.seats.types', // Tải trước hàng và ghế
            'rooms.theaters',
            'shifts'
        ])
            ->where('showtime_id', $showtime_id)
            ->firstOrFail();
        // Lấy giá vé
        $normalPrice = $showtime->normal_price;
        $vipPrice = $showtime->vip_price;

        $user_id = session('user_id');
        // dd( $user_id);
        // Lấy các ghế đã đặt từ bảng ticket_seats
        $bookedSeats = DB::table('tickets_seats')
            ->where('showtime_id', $showtime_id)
            ->pluck('seat_id')
            ->toArray();
        // dd( $bookedSeats);
        return view('frontend.layouts.booking.getSeatBooking', compact('showtime', 'normalPrice', 'vipPrice', 'user_id', 'bookedSeats'));
    }
    public function detailBooking(Request $request, $showtime_id)
    {
        if (!Auth::check()) {

            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để tiếp tục.');
        }

        $showtime = Showtime::findOrFail($showtime_id); // Lấy thông tin showtime

        $user_id = session('user_id');

        $foods = DB::table('foods')->get();
        $drinks = DB::table('drinks')->get();
        $combos = DB::table('combos')->get();

        // Nhận ghế đã chọn từ request
        $selectedSeats = $request->input('selected_seats');
        // session(['selectedSeats' => $selectedSeats]);
        $totalPrice = $request->input('total_price'); // Tổng giá tiền
        $seats = Seat::whereIn('seat_id', $selectedSeats)->get(); // Truy vấn các ghế từ cơ sở dữ liệu
        $seatNumbers = $seats->pluck('seat_number');
        // dd(   $selectedSeats);
        $genres = Genre::withCount('movies')->get();

        // $minutes = 10;
        // Cookie::queue('selected_seats', implode(',', $selectedSeats), $minutes);
        // Cache::put('selected_seats_' . session('user_id'), [
        //     'seats' => $selectedSeats,
        //     'total_price' => $totalPrice
        // ], now()->addMinutes(60));

        $combos = Combo::all();
        $foods = DB::table('foods')->get();
        $drinks = DB::table('drinks')->get();


        // dd($totalPrice);
        // Truyền dữ liệu đến view
        return view('frontend.layouts.booking.detailBooking', compact(
            'showtime',
            'selectedSeats', // Truyền mảng ghế đã chọn
            'totalPrice',
            'user_id',
            'seatNumbers',
            'genres',
            'foods',
            'drinks',
            'combos'
        ));
    }




}
