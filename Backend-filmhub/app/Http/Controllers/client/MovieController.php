<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function index()
    {
        // Lấy tất cả các phim từ cơ sở dữ liệu
        $movieUpcoming1 = Movie::where('status', 'Sắp ra mắt')
            ->orderBy('movie_id', 'asc')
            ->skip(0) // Bỏ qua 0 bản ghi
            ->take(8) // Lấy 8 bản ghi
            ->get();
        $movieUpcoming2 = Movie::where('status', 'Sắp ra mắt')
            ->orderBy('movie_id', 'asc')
            ->skip(8) // Bỏ qua 8 bản ghi
            ->take(8) // Lấy 8 bản ghi
            ->get();

        // Trả về view với danh sách phim
        return view('frontend.movies.index', compact('movieUpcoming1', 'movieUpcoming2'));
    }
    public function detail(string $id)
    {
        $movie = Movie::with('genres')->find($id); // Lấy phim cùng với các thể loại đã gắn
        $movie->release_date = Carbon::parse($movie->release_date)->format('d-m-Y');
        $directorRelatedMovies = Movie::where('director', $movie->director)
            ->where('movie_id', '!=', $movie->movie_id) // Loại trừ bộ phim hiện tại
            ->get();
        // dd($movie);
        return view('frontend.movies.detail', compact('movie', 'directorRelatedMovies'));
    }
}
