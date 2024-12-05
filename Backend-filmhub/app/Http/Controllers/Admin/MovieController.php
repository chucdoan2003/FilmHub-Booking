<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{

    const PATH_VIEW = 'admin.movies.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Movie::all();
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
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,genre_id',
            'status' => 'required',
            'director' => 'required',
            'performer' => 'required',
            'trailer' => 'required|url', // Đảm bảo trailer là URL hợp lệ
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
        ]);
        $movie = Movie::find($id);

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

        // Xóa các thể loại liên kết nếu cần thiết
        $movie->genres()->detach();

        // Xóa ảnh poster nếu có
        if ($movie->poster_url) {
            Storage::disk('public')->delete($movie->poster_url);
        }

        // Xóa phim
        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Phim đã được xóa thành công!');
    }
}
