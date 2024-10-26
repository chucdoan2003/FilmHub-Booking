<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        // Lưu phim vào cơ sở dữ liệu
       
        // Trả về phản hồi JSON
        return response()->json([
            'message' => 'Thêm phim thành công!',
            'movie' => "movie film add"
        ]);
    }
    public function show(){
        return view("admin.ajax.demo");
    }
}
