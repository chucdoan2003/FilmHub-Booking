<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        try {
            $foods = Food::all();
            return response()->json($foods, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not retrieve foods.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
            ]);

            $food = Food::create($request->all());
            return response()->json($food, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not create food.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $food = Food::findOrFail($id);
            return response()->json($food, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Food not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
            ]);

            $food = Food::findOrFail($id);
            $food->update($request->all());
            return response()->json($food, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not update food.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $food = Food::findOrFail($id);
            $food->delete();
            return response()->json(['message' => 'Food deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not delete food.'], 500);
        }
    }
}
