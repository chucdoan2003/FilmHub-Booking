<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{

    const PATH_VIEW = 'admin.movies.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Movie::orderBy('movie_id', 'desc')->get();
        // dd($data);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required|numeric',
            'release_date' => 'required|date',
            'poster_url' => 'required',
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,genre_id',
            'status' => 'required',
            'director' => 'required',
            'performer' => 'required',
            'trailer' => 'required|url', // Đảm bảo trailer là URL hợp lệ
            'type' => 'required|in:2D,3D',
        ], [
            'title.required' => 'Tiêu đề không được để trống.',
            'description.required' => 'Mô tả không được để trống.',
            'release_date.required' => 'Thời gian phát hành không được để trống.',
            'release_date.date' => 'Thời gian phát hành phải là ngày',
            'duration.required' => 'Thời lượng không được để trống.',
            'duration.numeric' => 'Thời lượng phải là một số.',
            'genres.required' => 'Thể loại không được để trống.',
            'status.required' => 'Trạng thái không được để trống.',
            'director.required' => 'Đạo diễn không được để trống.',
            'performer.required' => 'Diễn viên không được để trống.',
            'trailer.required' => 'Trailer không được để trống.',
            'poster_url.required' => 'Poster không được để trống.',
            'type.required' => 'Dạng phim không được để trống.',
            'type.in:2D,3D' => 'Dạng phim chỉ có thể là 2D hoặc 3D.',
        ]);

        // Xử lý đường dẫn trailer để chuyển đổi sang dạng embed
        if (str_contains($data['trailer'], 'watch?v=')) {
            $data['trailer'] = str_replace('watch?v=', 'embed/', $data['trailer']);
        }

        // Xử lý poster_url
        if ($request->hasFile('poster_url')) {
            $data['poster_url'] = $request->file('poster_url')->store('movie', 'public');
        } else {
            $data['poster_url'] = "";
        }

        // Tạo phim
        $movie = Movie::query()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'duration' => $data['duration'],
            'release_date' => $data['release_date'],
            'poster_url' => $data['poster_url'],
            'status' => $data['status'],
            'director' => $data['director'],
            'performer' => $data['performer'],
            'trailer' => $data['trailer'],
        ]);

        // Gắn thể loại phim
        $movie->genres()->attach($data['genres']);

        return redirect()->route('admin.movies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::with('genres')->find($id); // Lấy phim cùng với các thể loại đã gắn
        // dd($movie->genres);
        $genres = Genre::all(); // Lấy tất cả thể loại để hiển thị trong select box
        return view('admin.movies.show', compact('movie', 'genres'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movie = Movie::with('genres')->find($id); // Lấy phim cùng với các thể loại đã gắn
        // dd($movie->genres);
        $genres = Genre::all(); // Lấy tất cả thể loại để hiển thị trong select box
        return view('admin.movies.edit', compact('movie', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required|numeric',
            'release_date' => 'required|date',
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,genre_id',
            'status' => 'required',
            'director' => 'required',
            'performer' => 'required',
            'trailer' => 'required',
            'type' => 'required|in:2D,3D',
        ], [
            'title.required' => 'Tiêu đề không được để trống.',
            'description.required' => 'Mô tả không được để trống.',
            'release_date.required' => 'Thời gian phát hành không được để trống.',
            'release_date.date' => 'Thời gian phát hành phải là ngày.',
            'duration.required' => 'Thời lượng không được để trống.',
            'duration.numeric' => 'Thời lượng phải là một số.',
            'genres.required' => 'Thể loại không được để trống.',
            'status.required' => 'Trạng thái không được để trống.',
            'director.required' => 'Đạo diễn không được để trống.',
            'performer.required' => 'Diễn viên không được để trống.',
            'trailer.required' => 'Trailer không được để trống.',
            'type.required' => 'Dạng phim không được để trống.',
            'type.in:2D,3D' => 'Dạng phim chỉ có thể là 2D hoặc 3D.',
        ]);

        $movie = Movie::find($id);

        $currentDateTime = Carbon::now();

        // Kiểm tra nếu phim có ca chiếu
        $hasShowtimes = Showtime::where('movie_id', $movie->movie_id) // Lấy các ca chiếu của phim này
        ->where('datetime', '>=', $currentDateTime->toDateString()) // Ngày ca chiếu lớn hơn hoặc bằng ngày hiện tại
        ->orWhere(function ($query) use ($currentDateTime) {
            $query->where('datetime', $currentDateTime->toDateString()) // Ca chiếu hôm nay
                  ->whereHas('shifts', function ($shiftQuery) use ($currentDateTime) {
                      $shiftQuery->where('start_time', '>', $currentDateTime->format('H:i:s')); // Chưa bắt đầu
                  });
        })
        ->exists();
        if ($hasShowtimes) {
            return redirect()->back()->withErrors(['error' => 'Phim đang có ca chiếu chưa diễn ra , không thể chỉnh sửa.']);
        }

        // Xử lý đường dẫn trailer để chuyển đổi sang dạng embed
        if (str_contains($data['trailer'], 'watch?v=')) {
            $data['trailer'] = str_replace('watch?v=', 'embed/', $data['trailer']);
        }

        if ($request->hasFile('poster_url')) {
            if ($movie->poster_url) {
                Storage::delete($movie->poster_url);
            }
            $data['poster_url'] = $request->file('poster_url')->store('movie', 'public');
        } else {
            $data['poster_url'] = $movie->poster_url;
        }

        $movie->update($data);

        // Cập nhật lại các thể loại đã chọn
        $movie->genres()->sync($request->genres);

        return redirect()->route('admin.movies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);

        // Kiểm tra nếu phim đang có lịch chiếu
        if ($movie->showtimes()->exists()) {
            return redirect()->route('admin.movies.index')->with('error', 'Không thể xóa phim vì đang có lịch chiếu.');
        }

        // Kiểm tra nếu phim có bình luận
        if ($movie->comments()->exists()) {
            return redirect()->route('admin.movies.index')->with('error', 'Không thể xóa phim vì đang có bình luận.');
        }

        // Nếu không bị ràng buộc, thực hiện xóa
        $movie->genres()->detach();

        if ($movie->poster_url) {
            Storage::disk('public')->delete($movie->poster_url);
        }

        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Phim đã được xóa thành công!');
    }
}
