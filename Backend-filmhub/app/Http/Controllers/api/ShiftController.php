<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Theater;
use Illuminate\Http\Request;

class ShiftController extends Controller
{

    public function index(Theater $theater) {
        $shifts = $theater->shifts;
        return response()->json($shifts);
    }


    public function show(Theater $theater, Shift $shift) {
        return response()->json($shift);
    }


    public function store(Request $request, Theater $theater) {
        $validatedData = $request->validate([
            'shift_name' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        $shift = $theater->shifts()->create($validatedData);
        return response()->json($shift, 201);
    }


    public function update(Request $request, Theater $theater, Shift $shift) {
        $validatedData = $request->validate([
            'shift_name' => 'sometimes|required|string',
            'start_time' => 'sometimes|required',
            'end_time' => 'sometimes|required'
        ]);

        $shift->update($validatedData);
        return response()->json($shift);
    }


    public function destroy(Theater $theater, Shift $shift) {
        $shift->delete();
        return response()->json(null, 204);
    }
}


