<?php

namespace App\Http\Controllers\api;

use App\Models\Room;
use App\Models\Theater;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class TheaterController extends Controller
{

    public function index()
    {
        $theaters = Theater::with('rooms')
            ->get()
            ->map(function($theater) {
                return [
                    'theater' => $theater,
                    'number_of_rooms' => $theater->rooms->count(),
                ];
            });

        return response()->json($theaters);
    }


    public function show($id)
{
    $theater = Theater::with('rooms')->find($id); // chỉ lấy rooms, không lấy shifts

    if (!$theater) {
        return response()->json(['message' => 'Theater not found'], 404);
    }

    $theaterData = [
        'theater' => $theater,
        'number_of_rooms' => $theater->rooms->count(),
    ];

    return response()->json($theaterData);
}


public function store(Request $request) {
    try {
        $validatedData = $request->validate([
            'name' => 'required|string|min:1|not_regex:/^\s*$/u',
            'location' => 'required|string|min:1|not_regex:/^\s*$/u',
            'capacity' => 'required|integer|min:1'
        ], [
            'name.required' => 'Tên không được để trống.',
            'name.not_regex' => 'Tên không được chứa chỉ khoảng trắng.',
            'location.required' => 'Địa điểm không được để trống.',
            'location.not_regex' => 'Địa điểm không được chứa chỉ khoảng trắng.',
            'capacity.required' => 'Sức chứa không được để trống.',
            'capacity.min' => 'Sức chứa phải lớn hơn 0.'
        ]);

        $theater = Theater::create($validatedData);
        return response()->json($theater, 201);

    } catch (\Illuminate\Validation\ValidationException $e) {

        return response()->json([
            'message' => 'Dữ liệu nhập không hợp lệ.',
            'errors' => $e->errors()
        ], 422);
    }
}

public function update(Request $request, Theater $theater) {
    try {
        $validatedData = $request->validate([
            'name' => 'required|string|min:1|not_regex:/^\s*$/u',
            'location' => 'required|string|min:1|not_regex:/^\s*$/u',
            'capacity' => 'required|integer|min:1'
        ], [
            'name.required' => 'Tên không được để trống.',
            'name.not_regex' => 'Tên không được chứa chỉ khoảng trắng.',
            'location.required' => 'Địa điểm không được để trống.',
            'location.not_regex' => 'Địa điểm không được chứa chỉ khoảng trắng.',
            'capacity.required' => 'Sức chứa không được để trống.',
            'capacity.min' => 'Sức chứa phải lớn hơn 0.'
        ]);

        $theater->update($validatedData);
        return response()->json($theater);

    } catch (\Illuminate\Validation\ValidationException $e) {

        return response()->json([
            'message' => 'Dữ liệu nhập không hợp lệ.',
            'errors' => $e->errors()
        ], 422);
    }
}





public function destroy($id) {
    $theater = Theater::find($id);

    if (!$theater) {
        return response()->json(['message' => 'Theater not found'], 404);
    }

    $theater->delete();

    return response()->json(['message' => 'Theater deleted successfully'], 200);
}

}

