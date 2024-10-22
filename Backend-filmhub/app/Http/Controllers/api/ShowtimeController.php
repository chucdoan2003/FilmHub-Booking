<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Showtime;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    public function index()
    {
        try {
            $showtimes = Showtime::with(['movie', 'room', 'shift'])->get();
            return response()->json([
                'message' => 'Showtimes retrieved successfully.',
                'data' => $showtimes
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error fetching showtimes', 'error' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'movie_id' => 'required|exists:movies,movie_id',
                'room_id' => 'required|exists:rooms,room_id',
                'shift_id' => 'required|exists:shifts,shift_id',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
            ], [
                'movie_id.exists' => 'The selected movie ID does not exist.',
                'room_id.exists' => 'The selected room ID does not exist.',
                'shift_id.exists' => 'The selected shift ID does not exist.',
            ]);

            // Kiểm tra xem showtime đã tồn tại chưa
            $exists = Showtime::where('movie_id', $request->movie_id)
                ->where('room_id', $request->room_id)
                ->where('shift_id', $request->shift_id)
                ->where(function ($query) use ($request) {
                    $query->where('start_time', '<', $request->end_time)
                        ->where('end_time', '>', $request->start_time);
                })
                ->exists();

            if ($exists) {
                return response()->json(['error' => 'The selected movie, room, and shift combination already exists.'], 409);
            }

            // Tạo showtime mới
            $showtime = Showtime::create($request->all());
            return response()->json([
                'message' => 'Showtime created successfully.',
                'data' => $showtime
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error creating showtime', 'error' => $th->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $showtime = Showtime::with(['movie', 'room', 'shift'])->findOrFail($id);
            return response()->json([
                'message' => 'Showtime retrieved successfully.',
                'data' => $showtime
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error fetching showtime', 'error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, $showtime_id)
    {
        try {
            $showtime = Showtime::findOrFail($showtime_id);

            // Xác thực dữ liệu đầu vào
            $request->validate(
                [
                    'movie_id' => 'required|exists:movies,movie_id',
                    'room_id' => 'required|exists:rooms,room_id',
                    'shift_id' => 'required|exists:shifts,shift_id',
                    'start_time' => 'required|date',
                    'end_time' => 'required|date|after:start_time',
                ],
                [
                    'movie_id.exists' => 'The selected movie ID does not exist.',
                    'room_id.exists' => 'The selected room ID does not exist.',
                    'shift_id.exists' => 'The selected shift ID does not exist.',
                ]
            );

            // Kiểm tra xem showtime đã tồn tại chưa
            $exists = Showtime::where('movie_id', $request->movie_id)
                ->where('room_id', $request->room_id)
                ->where('shift_id', $request->shift_id)
                ->where('showtime_id', '!=', $showtime_id) // Loại trừ bản ghi hiện tại
                ->where(function ($query) use ($request) {
                    $query->where('start_time', '<', $request->end_time)
                        ->where('end_time', '>', $request->start_time);
                })
                ->exists();

            if ($exists) {
                return response()->json(['error' => 'The selected movie, room, and shift combination already exists.'], 409);
            }

            // Cập nhật showtime
            $showtime->update($request->all());
            return response()->json([
                'message' => 'Showtime updated successfully.',
                'data' => $showtime
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error updating showtime', 'error' => $th->getMessage()], 500);
        }
    }

    public function destroy($showtime_id)
    {
        try {
            $showtime = Showtime::findOrFail($showtime_id);
            $showtime->delete();
            return response()->json([
                'message' => 'Showtime deleted successfully.'
            ], 204);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error deleting showtime', 'error' => $th->getMessage()], 500);
        }
    }
}
