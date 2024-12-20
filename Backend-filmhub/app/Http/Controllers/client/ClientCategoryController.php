<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Movie;

class ClientCategoryController extends Controller
{
    public function index() {

        $genres = Genre::withCount('movies')->get();
        $movies = Movie::with('genres')->paginate(12);
        return view('frontend.category.index', compact('genres','movies'));
    }

    public function show($id) {
        $genres = Genre::withCount('movies')->get();


        $genre = Genre::find($id);

        if (!$genre) {

            return redirect()->route('category.index')->with('error', 'Danh mục không tồn tại');
        }

        $movies = $genre->movies()->paginate(12);

        if ($movies->isEmpty()) {

            return redirect()->route('category.index')->with('error', 'Không có phim nào trong danh mục này');
        }

        return view('frontend.category.index', compact('genres', 'movies', 'genre'));
    }

    public function search(Request $request) {
        $searchTerm = $request->input('search');

        // Tìm phim theo tên
        $movies = Movie::where('title', 'like', '%' . strtolower($searchTerm) . '%')
        ->with('genres')
        ->paginate(12);


        if ($movies->isEmpty()) {
            return redirect()->route('category.index')->with('error', 'Không tìm thấy phim nào');
        }

        $genres = Genre::withCount('movies')->get();

        return view('frontend.category.index', compact('movies','genres'));
    }


    // Client Header
    public function indexHeader()
{
    $genres = Genre::with(['movies' => function ($query) {
        $query->limit(5); // Giới hạn 5 phim mỗi danh mục
    }])->get();

    return view('frontend.category.index', compact('genres'));
}

}
