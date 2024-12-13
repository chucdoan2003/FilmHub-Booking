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
        $movieReleased1 = Movie::where('status', 'Đang chiếu')
            ->orderBy('movie_id', 'asc')
            ->skip(0) // Bỏ qua 0 bản ghi
            ->take(8) // Lấy 8 bản ghi
            ->get();
        $movieReleased2 = Movie::where('status', 'Đang chiếu')
            ->orderBy('movie_id', 'asc')
            ->skip(8) // Bỏ qua 8 bản ghi
            ->take(8) // Lấy 8 bản ghi
            ->get();

        // Trả về view với danh sách phim
        return view('frontend.movies.index', compact('movieUpcoming1', 'movieUpcoming2', 'movieReleased1', 'movieReleased2'));
    }
    public function detail(string $id)
    {
        $movie = Movie::with('genres')->find($id); // Lấy phim cùng với các thể loại đã gắn
        $movie->release_date = Carbon::parse($movie->release_date)->format('d-m-Y');
        // Lấy danh sách các thể loại của phim
        $genreIds = $movie->genres->pluck('genre_id')->toArray();

        // Lấy các phim cùng loại nhưng không bao gồm phim hiện tại
        $relatedMovies = Movie::whereHas('genres', function ($query) use ($genreIds) {
            $query->whereIn('genre_movie.genre_id', $genreIds); // Chỉ rõ 'genre_movie' là bảng cần dùng
        })
            ->where('movie_id', '!=', $movie->movie_id) // Loại trừ phim hiện tại
            ->limit(10) // Giới hạn số lượng phim trả về
            ->get();
        // dd($relatedMovies);
        return view('frontend.movies.detail', compact('movie', 'relatedMovies'));
    }
}
