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
use App\Models\SelectedSeat;
use App\Models\Combo;
use App\Models\Voucher;
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
        $userId = session('user_id');


        // Kiểm tra xem người dùng có bị cấm đặt vé không (3 lần cảnh báo)
        $warningCount = \DB::table('user_warning')
            ->where('user_id', $userId)
            ->count();

        if ($warningCount >= 3) {
            return redirect()->route('movies.index')->with('error', 'Bạn đã treo vé 3 lần nên tài khoản hiện đã bị cấm đặt vé. Vui lòng liên hệ để được giúp đỡ.');
        }


        $pendingTicket = \DB::table('tickets')
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->first();

        // Nếu có vé chưa thanh toán, trả về thông báo yêu cầu thanh toán vé cũ trước
        if ($pendingTicket) {
            return redirect()->route('movies.index')->with('error', 'Bạn cần hoàn thành thanh toán vé chưa hoàn thành trước khi đặt vé mới.');
        }

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


        // dd( $showtimeId);
        $user_id = session('user_id');
        // dd($user_id);

        $foods = DB::table('foods')->get();
        $drinks = DB::table('drinks')->get();
        $combos = DB::table('combos')->get();


        // dd($request->input('selected_seats'));
        // Nhận ghế đã chọn từ request
        $selectedSeats = $request->input('selected_seats');
        $existingSelectedSeats = session('selected_seats', []);

        // if (!empty($selectedSeats)) {
        //     // Lưu ghế đã chọn vào session
        //     session(['selected_seats' => $selectedSeats]);
        // } else {
        //     // Nếu không có ghế nào được chọn từ request, lấy từ session
        //     $selectedSeats = session('selected_seats', []);
        // }

        // dd(   $selectedSeats);
        // session(['selectedSeats' => $selectedSeats]);
        $totalPrice = $request->input('total_price'); // Tổng giá tiền




        // if (!empty($selectedSeats)) {
        //     $existingSeats = SelectedSeat::where('showtime_id', $showtimeId)
        //         ->where('user_id', $user_id)
        //         ->whereIn('seat_id', $selectedSeats)
        //         ->exists();

        //     if ($existingSeats) {
        //         return redirect()->back()->withErrors(['error' => 'Bạn không thể chọn lại ghế mà bạn đã chọn.']);
        //     }

        //     // Nếu không có lỗi, tiếp tục với logic của bạn
        // } else {
        //     return redirect()->back()->with('error', 'Không có ghế nào được chọn.');
        // }

        if (!empty($selectedSeats)) {
            foreach ($selectedSeats as $seatId) {
                $existingSeat = SelectedSeat::where('showtime_id', $showtime_id)
                    ->where('user_id', $user_id)
                    ->where('seat_id', $seatId)
                    ->first();

                // Nếu ghế đã được chọn cho showtime này, trả về thông báo lỗi
                if ($existingSeat) {
                    return redirect()->route('detailBooking', $showtimeId)->with('error', 'Ghế này đã được chọn , vui lòng chọn ghế khác');
                }

                // Thêm ghế vào cơ sở dữ liệu nếu chưa chọn
                try {
                    SelectedSeat::create([
                        'user_id' => $user_id,
                        'showtime_id' => $showtime_id,
                        'seat_id' => $seatId,
                        'totalPrice' => $totalPrice
                    ]);
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['error' => 'Lỗi khi lưu ghế.']);
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
                }  if ($seatType->type_id == 2) {
                    // Nếu là ghế VIP, dùng giá vip_price từ showtime
                    return $showtime->vip_price;
                }
            });


        // dd( $totalAmount);

        // Trích xuất danh sách seat_id
        $seatIds = $selectedSeats2->pluck('seat_id')->toArray();

        $seats = Seat::whereIn('seat_id', $seatIds)->get();

        // Lấy danh sách seat_number
        $seatNumbers = $seats->pluck('seat_number');

        // Kiểm tra ghế đã chọn
        // $existingSeats = SelectedSeat::where('showtime_id', $showtimeId)
        //     ->where('user_id', $user_id)
        //     ->whereIn('seat_id', $seatIds) // Sử dụng $seatIds thay vì $selectedSeats2
        //     ->exists();

        // if ($existingSeats) {
        //     return redirect()->back()->withErrors(['error' => 'Bạn không thể chọn lại ghế mà bạn đã chọn.']);
        // }
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
        $vouchers = Voucher::all();

        $usedVoucher = DB::table('vourcher_user')
            ->where('user_id', $user_id)
            ->pluck('vourcher_id')
            ->first();


        // dd($totalPrice);
        // Truyền dữ liệu đến view
        return view('frontend.layouts.booking.detailBooking', compact(
            'showtime',
            'selectedSeats2', // Truyền mảng ghế đã chọn
            'totalPrice',
            'user_id',
            'seatNumbers',
            'genres',
            'totalAmount',
            'foods',
            'drinks',
            'combos',
            'vouchers',
            'usedVoucher'
        ));
    }




}
