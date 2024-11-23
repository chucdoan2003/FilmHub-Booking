<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Drink;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function index()
    {
        try {
            $drinks = Drink::all();
            return response()->json($drinks, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not retrieve drinks.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
            ]);

            $drink = Drink::create($request->all());
            return response()->json($drink, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not create drink.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $drink = Drink::findOrFail($id);
            return response()->json($drink, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Drink not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
            ]);

            $drink = Drink::findOrFail($id);
            $drink->update($request->all());
            return response()->json($drink, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not update drink.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $drink = Drink::findOrFail($id);
            $drink->delete();
            return response()->json(['message' => 'Drink deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not delete drink.'], 500);
        }
    }
}
