<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShiftController extends Controller
{
    public function index()
    {
        try {
            $shift = Shift::all();
            return response()->json(['message' => 'Successfully fetching shift', 'data' => $shift], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching shift', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($shift_id)
    {
        try {
            $shift = Shift::findOrFail($shift_id);
            return response()->json(['message' => 'Successfully fetching shift', 'data' => $shift], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching shift', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            Log::info($request->all()); // Ghi lại dữ liệu nhận được

            $request->validate([
                'shift_name' => 'required|string|max:255',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);

            $shift = Shift::create($request->all());
            return response()->json(['message' => 'Shift created successfully', 'data' => $shift], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating shift', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $shift_id)
    {
        try {
            $shift = Shift::findOrFail($shift_id);

            $this->validate($request, [
                'shift_name' => 'sometimes|required|string|max:255',
                'start_time' => 'sometimes|required|date_format:H:i',
                'end_time' => 'sometimes|required|date_format:H:i|after:start_time',
            ]);

            $shift->update($request->all());
            return response()->json(['message' => 'Shift updated successfully', 'data' => $shift], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating shift', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($shift_id)
    {
        try {
            $shift = Shift::findOrFail($shift_id);
            $shift->delete();
            return response()->json(['message' => 'Shift deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting shift', 'error' => $e->getMessage()], 500);
        }
    }
}
