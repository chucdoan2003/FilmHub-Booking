<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use Carbon\Carbon;
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
