<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Models\Theater;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::with('theater')->latest()->paginate(5);
            return view("admin.users.list", compact('users'));
        } catch (\Throwable $th) {
            Log::error(__CLASS__ ."@".__FUNCTION__, [
                "line" => $th->getLine(),
                "message" => $th->getMessage()
            ]);
            return view("errors.404");
        }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator= $request->validate(
            [
            "name"=>"required",
            "email"=>"required|email",
            "password"=>"required",
            "password_confirmation"=>"required|same:password"
            ]
        );
        $user = User::query()->create($request->all());
        return redirect()->route('users.index')->with('success', 'Thêm người dùng thành công');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::query()->where("user_id", $id)->first();

        // Lấy tất cả các theater để hiển thị trong select box
        $theaters = Theater::all();

        return view('admin.users.edit', compact('user', 'theaters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        "name" => "required",
        "email" => "required|email",
        "theater_id" => "nullable|exists:theaters,theater_id", // Kiểm tra theater_id hợp lệ
    ]);
    // dd($request);

    // Cập nhật thông tin người dùng
    $user = User::query()->where('user_id', $id)->first();

    if ($request->theater_id) {
        $user->update([
            "status" => 'manager', // Đổi status thành 'manager' nếu có theater_id
        ]);
    }

    // Cập nhật thông tin người dùng
    $user->update([
        "name" => $request->name,
        "email" => $request->email,
        "theater_id" => $request->theater_id,  // Cập nhật theater_id
        "status" => $request->theater_id ? 'manager' : $user->status,
    ]);

    return redirect()->route('users.index')->with('success', 'Cập nhật người dùng thành công');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {
            $user = User::query()->where('user_id', $id)->delete();
            return redirect()->route('users.index')->with('success', 'Xóa người dùng thành công');

        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@". __FUNCTION__, [
                "line"=> $th->getLine(),
                "message"=>$th->getMessage()
            ]);
            // return view('errors.404');
        }
    }
}
