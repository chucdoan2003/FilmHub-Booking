<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Theater;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function index(Theater $theater) {
        $rooms = $theater->rooms;
        return response()->json($rooms);
    }


    public function show(Theater $theater, Room $room) {
        return response()->json($room);
    }


    public function store(Request $request, Theater $theater) {
        $validatedData = $request->validate([
            'room_name' => 'required|string',
            'capacity' => 'required|integer'
        ]);

        $room = $theater->rooms()->create($validatedData);
        return response()->json($room, 201);
    }


    public function update(Request $request, Theater $theater, Room $room) {
        $validatedData = $request->validate([
            'room_name' => 'sometimes|required|string',
            'capacity' => 'sometimes|required|integer'
        ]);

        $room->update($validatedData);
        return response()->json($room);
    }


    public function destroy(Theater $theater, Room $room) {
        $room->delete();
        return response()->json(null, 204);
    }
}

