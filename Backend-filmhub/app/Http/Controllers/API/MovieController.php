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
            $movie = Movie::with('genres')->get();
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
    public function store(StoreMovieRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show($movie_id)
    {
        try {
            $movie = Movie::with('genres')->find($movie_id);
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
    public function update(UpdateMovieRequest $request, $movie_id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($movie_id) {}
}
