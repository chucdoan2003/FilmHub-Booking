<?php

namespace App\Http\Controllers\admin;

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
use App\Models\Genre;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    public function getLogin()
    {
        $genres = Genre::withCount('movies')->get();
        return view("frontend.auth.login", compact('genres'));
    }
    public function getRegister()
    {
        return view("frontend.auth.register");
    }
    public function getForgotPassword()
    {
        return view("frontend.auth.forgotPassword");
    }

    public function login(Request $request)
{
    $validator = $request->validate([
        "email" => "required|email",
        "password" => "required"
    ]);

    $credentials = [
        "email" => $request->email,
        "password" => $request->password
    ];

    if (Auth::attempt($credentials)) {
        // Lấy thông tin người dùng sau khi đăng nhập thành công
        $isLogin = true;
            $user = Auth::user();
            session(['user_id' => $user->user_id]);

        // Kiểm tra `status` của người dùng
        if ($user->status === 'admin' || $user->status === 'manager') {
            // Chuyển hướng đến dashboard admin
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công với quyền quản trị!');
        } else {
            // Chuyển hướng đến giao diện frontend
            return redirect()->route('movies.index')->with('success', 'Đăng nhập thành công!');
        }
    } else {
        // Trả về giao diện đăng nhập với lỗi
        return back()->withErrors(['login' => 'Email hoặc mật khẩu không đúng.'])->withInput();
    }
}
    public function register(Request $request)
    {
        // Thêm người dùng vào cơ sở dữ liệu
        // try {
            $validator = Validator::make($request->all(), [
                "email" => "required|email",
                "password" => [
                    "required",
                    "string",
                    "min:8",  // Tối thiểu 8 ký tự
                    "max:20", // Tối đa 20 ký tự
                    "regex:/[a-z]/", // Ít nhất một ký tự thường
                    "regex:/[A-Z]/", // Ít nhất một ký tự in hoa
                    "regex:/[0-9]/", // Ít nhất một chữ số

                ],
                "password_confirmation" => "required|same:password"
            ], [
                // Email errors
                "email.required" => "Email là bắt buộc.",
                "email.email" => "Email không hợp lệ.",

                // Password errors
                "password.required" => "Mật khẩu là bắt buộc.",
                "password.string" => "Mật khẩu phải là một chuỗi ký tự.",
                "password.min" => "Mật khẩu phải có ít nhất :min ký tự.",
                "password.max" => "Mật khẩu không được vượt quá :max ký tự.",


                // Password confirmation errors
                "password_confirmation.required" => "Vui lòng xác nhận mật khẩu.",
                "password_confirmation.same" => "Mật khẩu xác nhận không khớp.",
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


        $user = User::query()->create($request->all());
        return view('frontend.auth.register', compact('user'));
        // } catch (\Throwable $th) {
        //     Log::error(__CLASS__ . "@". __FUNCTION__,[
        //         "line"=>$th->getLine(),
        //         "message"=>$th->getMessage()
        //     ]);
        //     return response()->json([
        //             "message"=>"Add User is fails",
        //             "RC"=>-1
        //         ], Response::HTTP_INTERNAL_SERVER_ERROR);
        // }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function forgotPassword(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if ($user) {
            Mail::to($user->email)->send(new ForgotPasswordMail($email));
            return view("frontend.auth.forgotPassword", compact("user"));

        } else {
            $user = false;
            return view("frontend.auth.forgotPassword", compact("user"));
        }
    }
    public function getChangePassword($email)
    {
        return view('frontend.auth.changePassword', compact('email'));
    }
    public function changePassword(Request $request)
    {
        $validator = $request->validate(
            [
                "password" => [
                    "required",
                    "string",
                    "min:8",  // Tối thiểu 8 ký tự
                    "max:20", // Tối đa 20 ký tự
                    "regex:/[a-z]/", // Ít nhất một ký tự thường
                    "regex:/[A-Z]/", // Ít nhất một ký tự in hoa
                    "regex:/[0-9]/", // Ít nhất một chữ số
                    "regex:/[@$!%*?&]/", // Ít nhất một ký tự đặc biệt],

                ],
                "password_confirmation" => "required|same:password"
            ]
        );


        if ($request->password == $request->password_confirmation) {
            $user = DB::table("users")
                ->where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);
            return view('frontend.auth.changePassword', compact('user'));
        }
    }
}
