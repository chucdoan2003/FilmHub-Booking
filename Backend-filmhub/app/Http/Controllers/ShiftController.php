<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShiftController extends Controller
{
    public function index()
    {
        return Shift::all();
    }

    public function store(Request $request)
    {
        Log::info($request->all()); // Ghi lại dữ liệu nhận được

        $request->validate([
            'shift_name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $shift = Shift::create($request->all());
        return response()->json(['message' => 'Shift created successfully', 'data' => $shift], 201);
    }

    public function show($shift_id)
    {
        return Shift::findOrFail($shift_id);
    }

    public function update(Request $request, $shift_id)
    {
        $shift = Shift::findOrFail($shift_id);

        $this->validate($request, [
            'shift_name' => 'sometimes|required|string|max:255',
            'start_time' => 'sometimes|required|date_format:H:i',
            'end_time' => 'sometimes|required|date_format:H:i|after:start_time',
        ]);

        $shift->update($request->all());
        return response()->json(['message' => 'Shift updated successfully', 'data' => $shift], 201);
    }

    public function destroy($shift_id)
    {
        $shift = Shift::findOrFail($shift_id);
        $shift->delete();
        // return response()->noContent();
        return response()->json(['message' => 'Shift delete successfully'], 201);
    }
}
