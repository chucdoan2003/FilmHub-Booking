<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\SendMailPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;


class SendMailController extends Controller
{
    public function sendMailPayMent(Request $request){
        if($request->email){
            // Send email using Laravel's Mailtrap or SMTP
            Mail::to($request->email)->send(new SendMailPayment($request->price));
            return response()->json(
                [
                    'message' => 'Quý khách thanh toán thành công, thông tin được gửi về địa chỉ email của quý khách'
                ], Response::HTTP_OK
        );
        }else{
            return response()->json(
                [
                    'error' => 'Email không tồn tại'
                ], Response::HTTP_BAD_REQUEST);
        }
    }
}
