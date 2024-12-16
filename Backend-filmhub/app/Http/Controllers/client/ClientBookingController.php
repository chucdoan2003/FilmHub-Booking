<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Combo;
use App\Models\Drink;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Showtime;
use Illuminate\Support\Facades\Auth;
use App\Models\Seat;
use App\Models\Voucher;
use App\Models\VourcherEvent;
use App\Models\VourcherRedeem;
use App\Models\VourcherUser;

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

        return view('frontend.layouts.booking.index', [
            'showtimesGroupedByDate' => $showtimesGroupedByDate,
            'selectedShowtimes' => $selectedShowtimes,
            'selectedDate' => $selectedDate,
            'movieId' => $id
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

        // Nhận ghế đã chọn từ request
        $selectedSeats = $request->input('selected_seats');
        $totalPrice = $request->input('total_price'); // Tổng giá tiền
        $seats = Seat::whereIn('seat_id', $selectedSeats)->get(); // Truy vấn các ghế từ cơ sở dữ liệu
        $seatNumbers = $seats->pluck('seat_number');
        // dd(   $selectedSeats);

        // Tải danh sách combos
        $combos = Combo::all();
        $foods = Food::all();
        $drinks = Drink::all();
        $currentDateTime = Carbon::now();
        $vouchers = VourcherRedeem::where('user_id', $user_id)->with('user')->get();
        $vourcherEvents = VourcherEvent::all(); // Lấy danh sách voucher event

           // Kiểm tra mã giảm giá đã sử dụng
        $usedVoucher = VourcherUser::where('user_id', $user_id)->pluck('vourcher_id')->toArray();
        // Lấy danh sách voucher sự kiện còn hạn
        $vourcherEvents = VourcherEvent::where('is_active', true)
        ->where('end_time', '>', $currentDateTime)
        ->get();


        // Truyền dữ liệu đến view
        return view('frontend.layouts.booking.detailBooking', compact(
            'showtime',
            'selectedSeats', // Truyền mảng ghế đã chọn
            'totalPrice',
            'user_id',
            'seatNumbers',
            'combos',
            'foods',
            'drinks',
            'vouchers',
            'vourcherEvents',
            'usedVoucher' // Truyền combos vào view
        ));
    }
    
}
