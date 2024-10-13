<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movie = Movie::all();
        return response()->json($movie, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        try {
            Log::info($request->all()); // Ghi lại dữ liệu nhận được

            $movie = $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'duration' => 'required|integer',
                'release_date' => 'required',
                'genre' => 'required|string',
                'rating' => 'required|numeric|min:1|max:5',
                'poster_url' => 'required',
            ]);

            $movie = Movie::create($request->all());
            return response()->json(['message' => 'Movie created successfully', 'data' => $movie], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating movie', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($movie_id)
    {
        try {
            $movies = Movie::find($movie_id);
            return response()->json($movies, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching movie', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, $movie_id)
    {
        try {
            $movie = Movie::findOrFail($movie_id);

            $this->validate($request, [
                'title' => 'required|string',
                'description' => 'required|string',
                'duration' => 'required|integer',
                'release_date' => 'required',
                'genre' => 'required|string',
                'rating' => 'required|numeric|min:1|max:5',
            ]);

            $movie->update($request->all());
            return response()->json(['message' => 'Movie updated successfully', 'data' => $movie], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating movie', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($movie_id)
    {
        try {
            $movie = Movie::findOrFail($movie_id);
            $movie->delete();
            return response()->json(['message' => 'Movie deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting movie', 'error' => $e->getMessage()], 500);
        }
    }
}
