<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function vnpay_payment(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'showtime_id' => 'required|exists:showtimes,showtime_id',
            'total' => 'required|numeric',
            'selected_seats' => 'required|string',
            'food_id' => 'nullable|integer',
            'drink_id' => 'nullable|integer',
            'combo_id' => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            // Create ticket
            $ticket = Ticket::create([
                'user_id' => $validated['user_id'],
                'showtime_id' => $validated['showtime_id'],
                'total_price' => $validated['total'],
                'ticket_time' => now(),
                'status' => 'pending',
                'food_id' => $validated['food_id'] ?? null,
                'drink_id' => $validated['drink_id'] ?? null,
                'combo_id' => $validated['combo_id'] ?? null,
            ]);

            // Save selected seats
            $selectedSeats = explode(',', $validated['selected_seats']);
            foreach ($selectedSeats as $seatId) {
                DB::table('tickets_seats')->insert([
                    'ticket_id' => $ticket->ticket_id,
                    'seat_id' => $seatId,
                    'showtime_id' => $validated['showtime_id'],
                ]);
            }



            // Generate VNPAY URL
            // $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            // $vnp_TmnCode = "HUV2CWXV";
            // $vnp_HashSecret = "8HOY25NHQSM6K2134OEFF1Z69GOJOSBG";
            // $vnp_TxnRef = date('YmdHis') . '-' . uniqid();
            // $vnp_Amount = $validated['total'] * 100;

            // $inputData = [
            //     "vnp_Version" => "2.1.0",
            //     "vnp_TmnCode" => $vnp_TmnCode,
            //     "vnp_Amount" => $vnp_Amount,
            //     "vnp_Command" => "pay",
            //     "vnp_CreateDate" => date('YmdHis'),
            //     "vnp_CurrCode" => "VND",
            //     "vnp_IpAddr" => $request->ip(),
            //     "vnp_Locale" => "VN",
            //     "vnp_OrderInfo" => "Thanh toán hóa đơn",
            //     "vnp_OrderType" => "FilmHub Booking",
            //     "vnp_ReturnUrl" => route('api.vnpay.return'),
            //     "vnp_TxnRef" => $vnp_TxnRef,
            // ];

            // ksort($inputData);
            // $hashData = urldecode(http_build_query($inputData));
            // $vnpSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
            // $vnp_Url .= '?' . http_build_query($inputData) . '&vnp_SecureHash=' . $vnpSecureHash;

            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = 'http://localhost:3000/vnpay-return';
            $vnp_TmnCode = "HUV2CWXV";//Mã website tại VNPAY
            $vnp_HashSecret = "8HOY25NHQSM6K2134OEFF1Z69GOJOSBG"; //Chuỗi bí mật

            $vnp_TxnRef = date('YmdHis') . '-' . uniqid(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY

            $vnp_OrderInfo = "Thanh toán hóa đơn";
            $vnp_OrderType = "FilmHub Booking";
            $vnp_Amount = $validated['total'] * 100;
            $vnp_Locale = "VN";
            $vnp_BankCode = "";
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $showtime_id = $validated['showtime_id'];


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

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

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

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'VNPAY URL generated successfully',
                'payment_url' => $vnp_Url,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process payment',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function vnpay_payment_return(Request $request)
    {
        $data = $request->all();

        // Retrieve ticket and user
        $ticket = Ticket::find($data['ticket_id']);
        $user = User::find($request->input('user_id'));

        if (!$ticket) {
            return response()->json(['status' => 'error', 'message' => 'Ticket not found'], 404);
        }

        try {
            if ($data['vnp_ResponseCode'] !== '00') {
                // Update ticket status
                $ticket->update(['status' => 'failed']);
                DB::table('tickets_seats')->where('ticket_id', $ticket->id)->delete();

                return response()->json(['status' => 'failed', 'message' => 'Payment failed, seats released.']);
            }

            // Update ticket status and add points to user
            $ticket->update(['status' => 'completed']);
            $pointsToAdd = $ticket->total_price / 1000;

            if ($user) {
                $user->increment('member_point', $pointsToAdd);
                if ($user->status !== 'member') {
                    $user->update(['status' => 'member']);
                }
            }

            return response()->json(['status' => 'success', 'message' => 'Payment successful, points added.']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process payment return',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
