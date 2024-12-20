<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    // Hiển thị danh sách món ăn
    public function index()
    {
        $foods = Food::all();
        return view('admin.combos.foods.index', compact('foods'));
    }

    // Hiển thị form tạo món ăn mới
    public function create()
    {
        return view('admin.combos.foods.create');
    }

    // Lưu món ăn mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Food::create($request->all());
        return redirect()->route('admin.foods.index')->with('success', 'Food created successfully.');
    }

    // Hiển thị chi tiết món ăn
    public function show($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.combos.foods.show', compact('food'));
    }

    // Hiển thị form chỉnh sửa món ăn
    public function edit($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.combos.foods.edit', compact('food'));
    }

    // Cập nhật món ăn
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $food = Food::findOrFail($id);
        $food->update($request->all());
        return redirect()->route('admin.foods.index')->with('success', 'Food updated successfully.');
    }

    // Xóa món ăn
    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        if ($food->tickets()->exists()) {
            return redirect()->route('admin.foods.index')->with('error', 'Không thể xóa món ăn vì đã có vé liên quan.');
        }
        $food->delete();
        return redirect()->route('admin.foods.index')->with('success', 'Food deleted successfully.');
    }
}
