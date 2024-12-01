<?php

namespace App\Http\Controllers\Admin;

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
    public function getLogin(){
        return view("frontend.auth.login");
    }
    public function getRegister(){
        return view("frontend.auth.register");
    }
    public function getForgotPassword(){
        return view("frontend.auth.forgotPassword");
    }
    public function login(Request $request){
        $credentials = [
            "email"=>$request->email,
            "password"=>$request->password
        ];

    if (Auth::attempt($credentials)) {
        // Đăng nhập thành công và Laravel tự động tạo session
        $user = Auth::user();
        return view("frontend.auth.login", compact('user'));
    }
    }
    public function register(StoreUserRequest $request){
        // Thêm người dùng vào cơ sở dữ liệu
        try {
            
            $user = User::query()->create($request->all());
            return view('frontend.auth.register', compact('user'));
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
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    public function forgotPassword(Request $request){
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if($user){
            Mail::to($user->email)->send(new ForgotPasswordMail($email));
            return view("frontend.auth.forgotPassword",compact("user"));
            
        }else{
            $user=false;
            return view("frontend.auth.forgotPassword", compact("user"));
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
