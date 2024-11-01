<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function vnpay_payment(Request $request) {

        $data = $request->all();

        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'showtime_id' => 'required|exists:showtimes,showtime_id',
            'total' => 'required|numeric',
            'selected_seats' => 'required|string',

        ]);

        // Lưu vé vào cơ sở dữ liệu
        $ticket = Ticket::create([
            'user_id' => $data['user_id'],
            'showtime_id' => $data['showtime_id'],
            'total_price' => $data['total'],
            'ticket_time' => now(), // Hoặc thời gian cụ thể nếu cần
        ]);

        // Lưu thông tin ghế đã chọn vào bảng ticket_seats
        $selectedSeats = explode(',', $data['selected_seats']);
        foreach ($selectedSeats as $seatId) {
            \DB::table('tickets_seats')->insert([
                'ticket_id' => $ticket->id,
                'seat_id' => $seatId,

            ]);
        }



    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = route('bookings.index');
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
        "vnp_Locale" =>   $vnp_Locale,
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




}
