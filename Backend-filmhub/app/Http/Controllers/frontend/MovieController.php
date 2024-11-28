<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        // Lấy tất cả các phim từ cơ sở dữ liệu
        $movies = Movie::all();
        // Trả về view với danh sách phim
        return view('frontend.movies.movies1', compact('movies'));
    }
}
