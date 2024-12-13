<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Combo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ComboController extends Controller
{
    // Lấy danh sách tất cả combo
    public function index()
    {
        try {
            $combos = Combo::with('foods', 'drinks')->get();
            if ($combos->isEmpty()) {
                return response()->json(['message' => 'Combo nothing.'], 404);
            }
            return response()->json($combos);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve combos.'], 500);
        }
    }

    // Tạo một combo mới
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'foods' => 'required|array',
                'drinks' => 'nullable|array',
            ]);

            $combo = Combo::create($request->only(['name', 'price']));
            $combo->foods()->attach($request->foods);

            if (isset($request->drinks) && !empty($request->drinks)) {
                $combo->drinks()->attach($request->drinks);
            }

            return response()->json($combo, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create combo.'], 500);
        }
    }

    // Lấy thông tin chi tiết một combo
    public function show($id)
    {
        try {
            $combo = Combo::with('foods', 'drinks')->findOrFail($id);
            return response()->json($combo);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Combo not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve combo.'], 500);
        }
    }

    // Cập nhật một combo
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'foods' => 'required|array',
                'drinks' => 'nullable|array',
            ]);

            $combo = Combo::findOrFail($id);
            $combo->update($request->only(['name', 'price']));
            $combo->foods()->sync($request->foods);

            if (isset($request->drinks) && !empty($request->drinks)) {
                $combo->drinks()->sync($request->drinks);
            } else {
                $combo->drinks()->detach();
            }

            return response()->json($combo);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Combo not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update combo.'], 500);
        }
    }

    // Xóa một combo
    public function destroy($id)
    {
        try {
            $combo = Combo::findOrFail($id);
            $combo->foods()->detach();
            $combo->drinks()->detach();
            $combo->delete();

            return response()->json(['message' => 'Combo deleted successfully.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Combo not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete combo.'], 500);
        }
    }
}
