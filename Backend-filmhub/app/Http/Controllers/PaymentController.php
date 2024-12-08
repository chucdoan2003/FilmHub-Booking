<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Models\Genre;
use App\Models\SelectedSeat;
class PaymentController extends Controller
{
    public function vnpay_payment(Request $request)
    {

        $data = $request->all();

        // dd($data);

        $selectedSeats = explode(',', $data['selected_seats']);

        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'showtime_id' => 'required|exists:showtimes,showtime_id',
            'total' => 'required|numeric',
            'selected_seats' => 'required|string',
            'food_id' => 'nullable|integer',
            'drink_id' => 'nullable|integer',
            'combo_id' => 'nullable|integer',
        ]);
        // dd($data['showtime_id']);

        $userId = $data['user_id'];

        // Kiểm tra xem người dùng có vé nào chưa thanh toán không (status = 'pending')
        $pendingTicket = \DB::table('tickets')
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->first();

        // Nếu có vé chưa thanh toán, trả về thông báo yêu cầu thanh toán vé cũ trước
        if ($pendingTicket) {
            return redirect()->route('movies.index')->with('error', 'Bạn cần hoàn thành thanh toán vé chưa hoàn thành trước khi đặt vé mới.');
        }


        $showtimeId = $data['showtime_id'];
        session(['user_id' => $data['user_id']]);

        $reservedSeats = \DB::table('tickets_seats')
            ->where('showtime_id', $showtimeId)
            ->whereIn('seat_id', $selectedSeats)
            ->pluck('seat_id')
            ->toArray();

        // Kiểm tra nếu có ghế trùng
        if (!empty($reservedSeats)) {
            $reservedSeatsList = implode(', ', $reservedSeats);
            return redirect()->back()->withErrors([
                'msg' => "Ghế $reservedSeatsList đã được đặt. Vui lòng chọn ghế khác."
            ]);
        }

        // Lưu vé vào cơ sở dữ liệu
        $ticket = Ticket::create([
            'user_id' => $data['user_id'],
            'showtime_id' => $data['showtime_id'],
            'total_price' => $data['total'],
            'ticket_time' => now(),
            'status' => 'pending',
            // 'food_id' => $data['food_id'],
            // 'drink_id' => $data['drink_id'],
            // 'combo_id' => $data['combo_id'],

        ]);

        // Lưu thông tin ghế đã chọn vào bảng ticket_seats
        foreach ($selectedSeats as $seatId) {
            // Kiểm tra seat_id tồn tại trong bảng seats
            $seat = \DB::table('seats')->where('seat_id', $seatId)->first();

            if ($seat) {
                // Nếu ghế hợp lệ, lưu vào bảng tickets_seats
                \DB::table('tickets_seats')->insert([
                    'ticket_id' => $ticket->ticket_id,
                    'seat_id' => $seat->seat_id,
                    'showtime_id' => $data['showtime_id'],
                ]);
            } else {
                return redirect()->back()->withErrors([
                    'msg' => "Không tìm thấy ghế với seat_id $seatId."
                ]);
            }
        }

        session(['ticket_id' => $ticket->ticket_id]);




        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TmnCode = "HUV2CWXV";//Mã website tại VNPAY
        $vnp_HashSecret = "8HOY25NHQSM6K2134OEFF1Z69GOJOSBG"; //Chuỗi bí mật

        $vnp_TxnRef = date('YmdHis') . '-' . uniqid(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY

        $vnp_OrderInfo = "Thanh toán hóa đơn";
        $vnp_OrderType = "FilmHub Booking";
        $vnp_Amount = $data['total'] * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $showtime_id = $data['showtime_id'];


        $selectedSeats = $request->input('selected_seats');
        // dd(  $selectedSeats);

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $showtime_id,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,


        );

        // dd( $inputData);

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }


        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }



        $userId = 1; // Thay đổi thành ID của người dùng thực tế
        $showtimeId = $request->input('showtime_id'); // Lấy showtime_id từ request
        $totalAmount = $request->input('total'); // Tổng số tiền

        // Kiểm tra các biến có dữ liệu không
        if (!$showtimeId) {
            return redirect()->back()->withErrors(['msg' => 'Showtime ID không hợp lệ']);
        }

        // Chuyển hướng tới VNPAY
        if ($vnp_Url) {
            return redirect()->away($vnp_Url);
        } else {
            // Nếu không có URL, bạn có thể xử lý lỗi ở đây
            return redirect()->route('bookings.index')->with('error', 'Có lỗi xảy ra khi thanh toán.');
        }

        // Lưu ticket vào cơ sở dữ liệu

        // if ($request->has('redirect')) {
        //     // Chuyển hướng tới VNPAY
        //     return redirect()->away($vnp_Url);
        // } else {
        //     // Lưu thông báo vào session khi thanh toán thành công
        //     session()->flash('message', 'Thanh toán thành công!');
        //     return redirect()->route(route: 'bookings.index')->with('success', 'Thành toán thành công');
        // }
        //     // vui lòng tham khảo thêm tại code demo


    }



    // public function vnpay_payment_return(Request $request)
    // {
    //     $data = $request->all();

    //     // Lấy ticket_id và user_id từ session
    //     $ticketId = session('ticket_id');
    //     $userId = session('user_id');  // Truy xuất user_id từ session

    //     $paymentStatus = $data['vnp_ResponseCode']; // Mã phản hồi từ VNPAY

    //     // Kiểm tra trạng thái thanh toán từ VNPAY


    //     // Kiểm tra vé thanh toán trong cơ sở dữ liệu
    //     $ticket = Ticket::where('ticket_id', $ticketId)->first();

    //     if ($paymentStatus != '00') {
    //         return redirect()->route('bookings.index')->with('status', 'Thanh toán thất bại');
    //     }

    //     if ($ticket) {
    //         // Cập nhật trạng thái vé thành 'completed'
    //         $ticket->status = 'completed';
    //         $ticket->save();

    //         // Kiểm tra và thêm điểm cho người dùng
    //         $user = User::find($userId);

    //         if ($user) {
    //             // Cộng điểm vào member_point (ví dụ, 100.000 VND = 100 điểm)
    //             $pointsToAdd = $ticket->total_price / 1000; // 1 điểm = 1.000 VND
    //             $user->member_point += $pointsToAdd;

    //             if ($user->status !== 'member') {
    //                 $user->status = 'member';
    //             }
    //             // Lưu lại thay đổi
    //             $user->save();

    //             return redirect()->route('bookings.index')->with('status', 'Thanh toán thành công và đã cộng điểm!');
    //         } else {
    //             return redirect()->route('bookings.index')->with('error', 'Không tìm thấy người dùng.');
    //         }
    //     } else {
    //         return redirect()->route('bookings.index')->with('error', 'Không tìm thấy vé thanh toán.');
    //     }
    // }


    public function vnpay_payment_return(Request $request)
    {
        $data = $request->all();

        // Lấy ticket_id và user_id từ session
        $ticketId = session('ticket_id');
        $userId = session('user_id');  // Truy xuất user_id từ session

        $paymentStatus = $data['vnp_ResponseCode']; // Mã phản hồi từ VNPAY

        // Kiểm tra trạng thái thanh toán từ VNPAY
        $ticket = Ticket::where('ticket_id', $ticketId)->first();

        if (!$ticket) {
            return redirect()->route('bookings.index')->with('error', 'Không tìm thấy vé thanh toán.');
        }

        if ($paymentStatus != '00') {
            // Nếu thanh toán thất bại, cập nhật trạng thái vé thành 'failed'
            $ticket->status = 'failed';
            $ticket->save();

            // Xóa các ghế đã lưu trong bảng tickets_seats
            \DB::table('tickets_seats')->where('ticket_id', $ticketId)->delete();

            return redirect()->route('bookings.index')->with('status', 'Thanh toán thất bại. Ghế đã được hủy.');
        }

        // Nếu thanh toán thành công
        $ticket->status = 'completed';
        $ticket->save();

        // Kiểm tra và thêm điểm cho người dùng
        $user = User::find($userId);

        if ($user) {
            // Cộng điểm vào member_point (ví dụ, 100.000 VND = 100 điểm)
            $pointsToAdd = $ticket->total_price / 1000; // 1 điểm = 1.000 VND
            $user->member_point += $pointsToAdd;

            if ($user->status !== 'member') {
                $user->status = 'member';
            }
            // Lưu lại thay đổi
            $user->save();

            return redirect()->route('confirmBooking')->with('status', 'Thanh toán thành công và đã cộng điểm!')->with($data);
        } else {
            return redirect()->route('bookings.index')->with('error', 'Không tìm thấy người dùng.');
        }
    }
    public function confirmBooking(Request $request)
    {
        // Lấy thông tin từ session
        $ticketId = $request->session()->get('ticket_id');
        $userId = session('user_id');
        $genres = Genre::withCount('movies')->get();
        // Kiểm tra dữ liệu
        if (!$ticketId || !$userId) {
            return redirect()->route('movies.index')->with('error', 'Không tìm thấy thông tin xác nhận.');
        }

        // Lấy thông tin vé
        $ticket = Ticket::with('ticketsSeats.seat')->where('ticket_id', $ticketId)->first();

        if (!$ticket) {
            return redirect()->route('movies.index')->with('error', 'Không tìm thấy vé.');
        }

        $showtimeId = $ticket->showtime_id; // Giả sử bạn đã lưu showtime_id trong ticket
    SelectedSeat::where('user_id', $userId)
        ->where('showtime_id', $showtimeId)
        ->delete();

        // Lấy thông tin suất chiếu và người dùng
        $showtime = Showtime::with('movie')->find($ticket->showtime_id);
        $user = User::find($userId);

        if (!$showtime || !$user) {
            return redirect()->route('movies.index')->with('error', 'Dữ liệu không đầy đủ để xác nhận.');
        }

        // Trả về view xác nhận với dữ liệu cần thiết
        return view('frontend.layouts.booking.confirmBooking', [
            'ticket' => $ticket,
            'showtime' => $showtime,
            'user' => $user,
            'movie' => $showtime->movie,
            'theater' => $showtime->theater,
            'genres' => $genres
        ]);
    }


}
