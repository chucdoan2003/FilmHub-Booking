<?php

namespace App\Http\Controllers;
use App\Mail\PaymentSuccessMail;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Models\Genre;
use App\Models\SelectedSeat;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
class PaymentController extends Controller
{
    public function vnpay_payment(Request $request)
    {




        //voucher
        $discountCode = $request->input('discount_code');
        // dd($discountCode);
        $userId = $request->input('user_id');
        $totalPrice = $request->input('total'); // Giá trước khi giảm

        // Kiểm tra mã giảm giá
        try {
            $vourcher = \DB::table('vourchers_redeem')->where('id', $discountCode)->first();
            if (!$vourcher) {
                $vourcher = \DB::table('vourcher_event')->where('id', $discountCode)->first();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'Lỗi khi truy vấn mã giảm giá: ' . $e->getMessage()]);
        }
        if ($vourcher) {
            // Tính toán số tiền giảm
            $discountAmount = ($totalPrice * $vourcher->discount_percentage) / 100;

            // Giảm tối đa
            if ($discountAmount > $vourcher->max_discount_amount) {
                $discountAmount = $vourcher->max_discount_amount;
            }

            // Áp dụng giảm giá
            $totalPrice -= $discountAmount;

            session(['discount_code' => $vourcher->id]);
            // Lưu mã giảm giá đã sử dụng
            // \DB::table('vourcher_user')->insert([
            //     'user_id' => $userId,
            //     'vourcher_id' => $vourcher->id,
            //     'created_at' => now(),
            // ]);
            
            
        }




        $data = $request->all();
        $showtimeId = $data['showtime_id'];

        $showtime = Showtime::find($showtimeId);  // Giả sử bạn lấy showtime từ cơ sở dữ liệu

        // Kiểm tra nếu không tìm thấy showtime
        if (!$showtime) {
            return redirect()->route('movies.index')->with('error', 'Không tìm thấy ca chiếu.');
        }


        $showtimeStartDate = Carbon::parse($showtime->datetime)->setTimezone('Asia/Ho_Chi_Minh'); // Đảm bảo múi giờ là Việt Nam
        $showtimeStartTime = Carbon::createFromFormat('H:i:s', $showtime->shifts->start_time);  // Giờ bắt đầu từ shifts
        $showtimeStart = $showtimeStartDate->setTimeFromTimeString($showtimeStartTime->toTimeString());  // Thời gian buổi chiếu

        // Lấy thời gian hiện tại
        $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');  // Đảm bảo thời gian hiện tại là múi giờ Việt Nam

        // Kiểm tra nếu thời gian hiện tại đã qua thời gian bắt đầu của ca chiếu
        if ($currentDateTime->gt($showtimeStart)) {
            return redirect()->route('movies.index')->with('error', 'Ca chiếu đã qua, vui lòng chọn ca chiếu khác.');
        }

        // dd($data);

        $selectedSeats = explode(',', $data['selected_seats']);

        foreach ($selectedSeats as $seatId) {
            $seatExists = \DB::table('selected_seats')->where('seat_id', $seatId)->exists();
            if (!$seatExists) {
                return redirect()->route('getSeatBooking', $showtimeId)->with('error', 'Vui lòng chọn lại ghế do quá thời gian');
            }
        }

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



        session(['user_id' => $data['user_id']]);

        $existingSeats = \DB::table('tickets_seats')
            ->whereIn('seat_id', $selectedSeats)
            ->where('showtime_id', $data['showtime_id'])
            ->exists(); // Kiểm tra xem có ghế nào trùng không

        if ($existingSeats) {
            // Nếu có ghế trùng, trả về trang chủ với thông báo lỗi
            return redirect()->route('getSeatBooking', $showtimeId)->with('error', 'Một hoặc nhiều ghế đã được đặt. Vui lòng chọn ghế khác.');
        }

        // Lưu vé vào cơ sở dữ liệu
        $ticket = Ticket::create([
            'user_id' => $data['user_id'],
            'showtime_id' => $data['showtime_id'],
            'total_price' => $data['total'],
            'ticket_time' => now(),
            'status' => 'pending',
            'food_id' => $data['food_id'],
            'drink_id' => $data['drink_id'],
            'combo_id' => $data['combo_id'],

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
                    'created_at' => now(),
                ]);
            } else {
                return redirect()->back()->withErrors([
                    'msg' => "Không tìm thấy ghế với seat_id $seatId."
                ]);
            }
        }

        session(['ticket_id' => $ticket->ticket_id]);
        session(['showtime_id' => $data['showtime_id']]);





        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return', );
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



        // Chuyển hướng tới VNPAY
        if ($vnp_Url) {
            return redirect()->away($vnp_Url);

        } else {
            // Nếu không có URL, bạn có thể xử lý lỗi ở đây
            return redirect()->route('movies.index')->with('error', 'Có lỗi xảy ra khi thanh toán.');
        }



    }

    public function vnpay_payment_return(Request $request)
    {
        $data = $request->all();


        // Lấy ticket_id và user_id từ session
        $ticketId = session('ticket_id');
        $userId = session('user_id');
        // dd($userId); // Truy xuất user_id từ session
        $showtimeId = session('showtime_id');

        $showtime = Showtime::find($showtimeId);  // Giả sử bạn lấy showtime từ cơ sở dữ liệu

        // Kiểm tra nếu không tìm thấy showtime
        if (!$showtime) {
            return redirect()->route('movies.index')->with('error', 'Không tìm thấy ca chiếu.');
        }

        $showtimeStartDate = Carbon::parse($showtime->datetime)->setTimezone('Asia/Ho_Chi_Minh'); // Đảm bảo múi giờ là Việt Nam
        $showtimeStartTime = Carbon::createFromFormat('H:i:s', $showtime->shifts->start_time);  // Giờ bắt đầu từ shifts
        $showtimeStart = $showtimeStartDate->setTimeFromTimeString($showtimeStartTime->toTimeString());  // Thời gian buổi chiếu

        $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');  // Đảm bảo thời gian hiện tại là múi giờ Việt Nam

        // Kiểm tra nếu thời gian hiện tại đã qua thời gian bắt đầu của ca chiếu
        if ($currentDateTime->gt($showtimeStart)) {
            return redirect()->route('movies.index')->with('error', 'Thanh toán thất bại do ca chiếu đã hết thời gian thanh toán , vui lòng chọn ca chiếu khác.');
        }


        $paymentStatus = $data['vnp_ResponseCode']; // Mã phản hồi từ VNPAY

        // Kiểm tra trạng thái thanh toán từ VNPAY
        $ticket = Ticket::where('ticket_id', $ticketId)->first();

        if (!$ticket) {
            return redirect()->route('movies.index')->with('error', 'Không tìm thấy vé thanh toán.');
        }

        if ($paymentStatus != '00') {
            // Nếu thanh toán thất bại, cập nhật trạng thái vé thành 'failed'
            if (!$ticket) {
                // Nếu không tìm thấy vé trong cơ sở dữ liệu, trả về trang chủ
                return redirect()->route('movies.index');
            } else {
                // Xóa các ghế đã lưu trong bảng tickets_seats
                \DB::table('tickets_seats')->where('ticket_id', $ticketId)->delete();

                SelectedSeat::where('user_id', $userId)
                    ->where('showtime_id', $showtimeId)
                    ->delete();

                // Xóa vé trong bảng tickets
                $ticket->delete();

                return redirect()->route('movies.index')->with('status', 'Thanh toán thất bại. Ghế đã được hủy.');
            }


        }

        // Nếu thanh toán thành công
        $ticket->status = 'completed';
        $ticket->save();

        SelectedSeat::where('user_id', $userId)
            ->where('showtime_id', $showtimeId)
            ->delete();

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
            // Gửi email xác nhận thanh toán thành công
            // try {
            //     Mail::to($user->email)->send(new PaymentSuccessMail($ticket));
            // } catch (\Exception $e) {
            //     // Nếu lỗi khi gửi email, ghi log và tiếp tục xử lý
            //     \Log::error('Không thể gửi email xác nhận: ' . $e->getMessage());
            // }

            \DB::table('payments')->insert([
                'user_id' => $userId,
                'amount' => $ticket->total_price, // Tổng tiền thanh toán
                'payment_method' => 'VNPAY', // Phương thức thanh toán
                'payment_time' => now(), // Thời gian thanh toán
                'ticket_id' => $ticketId,
            ]);

            $discountCode = session('discount_code');
            // dd($discountCode);
            if ($discountCode) {
                // Lấy thông tin voucher từ bảng vourchers_redeem
                $voucher = \DB::table('vourchers_redeem')->where('id', $discountCode)->first();

                // Kiểm tra xem voucher có tồn tại
                if ($voucher) {
                    // Nếu voucher là loại redeem
                    // Xóa voucher từ bảng vourchers_redeem

                    \DB::table('vourchers_redeem')->where('id', $discountCode)->delete();
                    // Nếu voucher là loại event
                } else {
                    $eventVoucher = \DB::table('vourcher_event')->where('id', $discountCode)->first();
                    // Nếu voucher là loại event và đang hoạt động
                    if ($eventVoucher && $eventVoucher->is_active) {
                        // Lưu thông tin vào bảng vourcher_user
                        \DB::table('vourcher_user')->insert([
                            'user_id' => $userId, // Giả sử $userId đã được định nghĩa trước đó
                            'vourcher_id' => $eventVoucher->id,
                            'created_at' => now(),
                        ]);
                    }
                }


                // Xóa discount_code khỏi session
                session()->forget('discount_code');
            }

            return redirect()->route('confirmBooking')->with('status', 'Thanh toán thành công và đã cộng điểm!')->with($data);
        } else {
            return redirect()->route('movies.index')->with('error', 'Không tìm thấy người dùng.');
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
?>