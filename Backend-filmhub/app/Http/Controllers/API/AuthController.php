<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreUserRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
   
    public function login(Request $request)
    {

        $credentials = [
            "email"=>$request->email,
            "password"=>$request->password
        ];

    if (Auth::attempt($credentials)) {
        // Đăng nhập thành công và Laravel tự động tạo session
        $user = Auth::user();
        
        // Tạo thông báo hoặc dữ liệu response
        return response()->json(['message' => 'Login successful', 'user' => $user]);
    } else {
        // Đăng nhập thất bại
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    }
    public function logout(Request $request)
    {
        Auth::logout();

        // Xóa tất cả session
        session()->flush();
    
        return response()->json(['message' => 'Logout successful']);
    }
    public function profile(){

        return response()->json(auth()->user());
    }

  
    public function register(StoreUserRequest $request)
    {
        try {
            
            $user = User::query()->create($request->all());
            if(!$user){
                return response()->json([
                    "message"=>"Add User is fails",
                    "RC"=>-1
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }else{
                return response()->json([
                    "message"=>"Register User succed",
                    "RC"=>0,
                    "data"=>$user
                ], Response::HTTP_OK);

            }
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@". __FUNCTION__,[
                "line"=>$th->getLine(),
                "message"=>$th->getMessage()
            ]);
            return response()->json([
                    "message"=>"Add User is fails",
                    "RC"=>-1
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }   
    }
    public function fogotPassword(Request $request){
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if($user){
            Mail::to($user->email)->send(new ForgotPasswordMail($email));
            return response()->json([
                "message"=>"Vui lòng kiểm tra email để thay đổi mật khẩu",
            ], Response::HTTP_OK);
            
        }else{
            return response()->json([
                "message"=>"Email không tồn tại",
            ], Response::HTTP_NOT_FOUND);
        }
        
    }
    public function getChangePassword($email){
        return view('frontend.auth.changePassword', compact('email'));
    }
    public function changePassword(Request $request){
        if($request->password == $request->password_confirmation){
            $user= DB::table("users")
            ->where('email',$request->email)
            ->update(['password'=>Hash::make($request->password)]);
            return response()->json([
                'message' => 'Password changed successfully',
            ]);
        }
        



    
}
}