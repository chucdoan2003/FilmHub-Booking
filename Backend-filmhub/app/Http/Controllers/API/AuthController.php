<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
}
