<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $movie = Movie::with(['genres', 'comments.user:id,name'])->get();
            return response()->json(['message' => 'Movie get All successfully', 'data' => $movie], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching Movie', 'error' => $e->getMessage()], 500);
        }
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
            $movie = Movie::with(['genres', 'comments.user'])->find($movie_id);
            return response()->json(['message' => 'Movie get one successfully', 'data' => $movie], 200);
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
