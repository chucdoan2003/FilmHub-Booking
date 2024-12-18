<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Combo;
use App\Models\Drink;
use App\Models\Food;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Showtime;
use Illuminate\Support\Facades\Auth;
use App\Models\Seat;
use App\Models\SelectedSeat;
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

        $showtime = Showtime::find($showtime_id);
        if ($showtime) {
            $showtimeId = $showtime->showtime_id;

        }

        $user_id = session('user_id');

        $selectedSeats = $request->input('selected_seats');
        $existingSelectedSeats = session('selected_seats', []);
        $totalPrice = $request->input('total_price'); // Tổng giá tiền
        // Nhận ghế đã chọn từ request
        // $selectedSeats = $request->input('selected_seats');
        // $totalPrice = $request->input('total_price'); // Tổng giá tiền
        // $seats = Seat::whereIn('seat_id', $selectedSeats)->get(); // Truy vấn các ghế từ cơ sở dữ liệu
        // $seatNumbers = $seats->pluck('seat_number');
        // dd(   $selectedSeats);

        if (!empty($selectedSeats)) {
            // Lấy danh sách ghế đã chọn trước đó
            $existingSelectedSeats = SelectedSeat::where('showtime_id', $showtime_id)
                ->where('user_id', $user_id)
                ->pluck('seat_id')
                ->toArray();

            // Xóa ghế đã chọn trước đó
            SelectedSeat::where('showtime_id', $showtime_id)
                ->where('user_id', $user_id)
                ->delete();

            // Thêm ghế mới
            foreach ($selectedSeats as $seatId) {
                try {
                    SelectedSeat::create([
                        'user_id' => $user_id,
                        'showtime_id' => $showtime_id,
                        'seat_id' => $seatId,
                        'totalPrice' => $totalPrice
                    ]);
                } catch (\Exception $e) {
                    // Nếu có lỗi khi thêm ghế, khôi phục ghế cũ
                    foreach ($existingSelectedSeats as $oldSeatId) {
                        SelectedSeat::create([
                            'user_id' => $user_id,
                            'showtime_id' => $showtime_id,
                            'seat_id' => $oldSeatId,
                            'totalPrice' => $totalPrice
                        ]);
                    }
                    return redirect()->back()->withErrors(['error' => 'Lỗi khi lưu ghế mới.']);
                }
            }
        }

        $selectedSeats2 = SelectedSeat::where('user_id', $user_id)
            ->where('showtime_id', $showtimeId)
            ->with(['seat', 'seat.rows', 'seat.types'])
            ->get();

        $totalAmount = $selectedSeats2->sum(function ($selectedSeat) use ($showtime) {
            // Kiểm tra loại ghế và lấy giá tương ứng
            $seatType = $selectedSeat->seat->types; // Lấy thông tin loại ghế (thường hay VIP)

            if ($seatType->type_id == 1) {
                // Nếu là ghế thường, dùng giá normal_price từ showtime
                return $showtime->normal_price;
            }if ($seatType->type_id == 2) {
                // Nếu là ghế VIP, dùng giá vip_price từ showtime
                return $showtime->vip_price;
            }
        });

        $seatIds = $selectedSeats2->pluck('seat_id')->toArray();

        $seats = Seat::whereIn('seat_id', $seatIds)->get();

        $genres = Genre::withCount('movies')->get();

        // Lấy danh sách seat_number
        $seatNumbers = $seats->pluck('seat_number');

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
            'selectedSeats2', // Truyền mảng ghế đã chọn
            'totalPrice',
            'user_id',
            'seatNumbers',
            'genres',
            'totalAmount',
            'combos',
            'foods',
            'drinks',
            'vouchers',
            'vourcherEvents',
            'usedVoucher' // Truyền combos vào view
        ));
    }
    
}
