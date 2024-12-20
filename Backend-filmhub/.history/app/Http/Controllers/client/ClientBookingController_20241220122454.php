<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Drink;
use App\Models\Food;
use App\Models\VourcherUser;
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
use App\Models\VourcherEvent;
use App\Models\VourcherRedeem;

class ClientBookingController extends Controller
{
    public function index($id, Request $request)
    {
        // Lấy thời gian hiện tại
        $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');

        $showtimes = DB::table('showtimes')
            ->join('rooms', 'showtimes.room_id', '=', 'rooms.room_id')
            ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id')
            ->join('theaters', 'showtimes.theater_id', '=', 'theaters.theater_id')
            ->where('showtimes.movie_id', $id)
            ->where(function ($query) use ($currentDateTime) {
                $query->whereRaw('DATE(showtimes.datetime) > ?', [$currentDateTime->toDateString()])
                    ->orWhere(function ($subQuery) use ($currentDateTime) {
                        $subQuery->whereRaw('DATE(showtimes.datetime) = ?', [$currentDateTime->toDateString()])
                            ->whereRaw('shifts.start_time >= ?', [$currentDateTime->format('H:i:s')]);
                    });
            })
            ->select(
                'showtimes.showtime_id',
                DB::raw('DATE(showtimes.datetime) AS show_date'),
                'shifts.start_time',
                'showtimes.normal_price',
                'showtimes.vip_price',
                'rooms.room_name as room_name',
                'theaters.name as theater_name',
                'theaters.theater_id'
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
            $selectedShowtimes = $showtimesGroupedByDate->get($selectedDate, collect());
        } else {
            $selectedShowtimes = $showtimes;
        }

        // Lấy danh sách các rạp có chứa showtime của phim
        $theaters = DB::table('theaters')
            ->join('showtimes', 'theaters.theater_id', '=', 'showtimes.theater_id')
            ->where('showtimes.movie_id', $id)
            ->select('theaters.theater_id', 'theaters.name')
            ->distinct()
            ->get();

        return view('frontend.layouts.booking.index', [
            'showtimesGroupedByDate' => $showtimesGroupedByDate,
            'selectedShowtimes' => $selectedShowtimes,
            'selectedDate' => $selectedDate,
            'movieId' => $id,
            'theaters' => $theaters,
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
            'rooms.rows.seats.types',
            'rooms.theaters',
            'shifts'
        ])
            ->where('showtime_id', $showtime_id)
            ->firstOrFail();

        $currentDateTime = Carbon::now();
        $showtimeStartDate = Carbon::parse($showtime->datetime);
        $showtimeStartTime = Carbon::createFromFormat('H:i:s', $showtime->shifts->start_time);
        $showtimeStart = $showtimeStartDate->setTimeFromTimeString($showtimeStartTime->toTimeString());

        // Kiểm tra nếu ca chiếu đã qua
        if ($showtimeStart->isPast()) {
            return redirect()->route('movies.index')->with('error', 'Ca chiếu đã qua, vui lòng chọn ca chiếu khác.');
        }

        if ($currentDateTime->diffInMinutes($showtimeStart, false) <= 8) {
            return redirect()->route('movies.index')->with('error', 'Sắp đến giờ chiếu nên sẽ đóng đặt vé trực tuyến, vui lòng mua vé trực tiếp tại quầy hoặc chọn ca chiếu khác.');
        }

        $user_id = session('user_id');

        // Lấy giá vé
        $normalPrice = $showtime->normal_price;
        $vipPrice = $showtime->vip_price;
        // dd( $user_id);
        // Lấy các ghế đã đặt từ bảng ticket_seats
        $bookedSeats = DB::table('tickets_seats')
            ->where('showtime_id', $showtime_id)
            ->pluck('seat_id')
            ->toArray();

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
            ->where('showtime_id', $showtime_id)
            ->with(['seat', 'seat.rows', 'seat.types'])
            ->get();

        if ($selectedSeats2->isNotEmpty()) {
            // Lấy room_id từ showtime_id
            $roomId = Showtime::where('room_id', $showtime_id)->value('room_id');

            // Lấy toàn bộ ghế theo room_id
            $allSeats = Seat::where('room_id', $roomId)->get();

            // Lấy giá trị của normal_price và vip_price từ showtime
            $showtime = Showtime::find($showtime_id);

            // Gắn giá dựa trên loại ghế
            $selectedSeats2->transform(function ($selectedSeat) use ($showtime, $allSeats) {
                $seat = $selectedSeat->seat;

                // Tìm loại ghế và gắn giá tương ứng
                $typeId = $seat->type_id; // Lấy type_id từ seat
                if ($typeId == 'normal') {
                    $selectedSeat->price = $showtime->normal_price;
                } elseif ($typeId == 'vip') {
                    $selectedSeat->price = $showtime->vip_price;
                } else {
                    $selectedSeat->price = 0; // Giá mặc định nếu không phải normal hoặc vip
                }

                return $selectedSeat;
            });
        }

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

        // Tải danh sách combos
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
            'vourcherEvents',
            'usedVoucher'
        ));
    }

}
