<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function vnpay_payment(Request $request)
    {

        $data = $request->all();


        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'showtime_id' => 'required|exists:showtimes,showtime_id',
            'total' => 'required|numeric',
            'selected_seats' => 'required|string',

        ]);
        // dd($data['showtime_id']);



        // Lưu vé vào cơ sở dữ liệu
        $ticket = Ticket::create([
            'user_id' => $data['user_id'],
            'showtime_id' => $data['showtime_id'],
            'total_price' => $data['total'],
            'ticket_time' => now(),
            'status' => 'pending',
        ]);

        // Lưu thông tin ghế đã chọn vào bảng ticket_seats
        $selectedSeats = explode(',', $data['selected_seats']);
        foreach ($selectedSeats as $seatId) {
            \DB::table('tickets_seats')->insert([
                'ticket_id' => $ticket->ticket_id, // Sử dụng ticket_id thay vì id
                'seat_id' => $seatId,
                'showtime_id' => $data['showtime_id'],
            ]);
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



    public function vnpay_payment_return(Request $request)
{
    $data = $request->all();

    $ticketId = session('ticket_id');
    $paymentStatus = $data['vnp_ResponseCode']; // Mã phản hồi từ VNPAY

    // Kiểm tra trạng thái thanh toán từ VNPAY

    $ticket = Ticket::where('ticket_id', $ticketId)->first();

    if ($ticket) {
        // Kiểm tra xem vé có thanh toán trong vòng 15 phút không
        // $createdAt = $ticket->created_at;
        // $currentTime = now();
        // $timeDifference = $currentTime->diffInMinutes($createdAt);

        // // Nếu thời gian thanh toán quá 15 phút
        // if ($timeDifference > 15) {
        //     $ticket->status = 'failed'; // Đánh dấu vé là failed nếu quá thời gian
        //     $ticket->save(); // Cập nhật lại trạng thái
        //     return redirect()->route('bookings.index')->with('error', 'Thời gian thanh toán đã hết hạn.');
        // }

        // Cập nhật trạng thái vé khi thanh toán thành công hoặc thất bại
        if ($paymentStatus == '00') { // VNPAY trả về mã '00' khi thanh toán thành công
            $ticket->status = 'completed'; // Cập nhật trạng thái thành 'completed'
        } else {
            $ticket->status = 'failed'; // Nếu mã khác '00', thanh toán thất bại
        }

        $ticket->save(); // Lưu lại thông tin ticket với trạng thái mới

        return redirect()->route('bookings.index')->with('status', 'Thanh toán thành công!');
    } else {
        return redirect()->route('bookings.index')->with('error', 'Ticket không hợp lệ.');
    }
}






}
