<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Combo;
use App\Models\Drink;
use App\Models\Food;
use App\Models\ComboFoodDrink;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    public function index()
    {
        $combos = Combo::with('foods', 'drinks')->get();
        return view('admin.combos.index', compact('combos'));
    }

    // Hiển thị form tạo combo mới
    public function create()
    {
        $foods = Food::all();
        $drinks = Drink::all();
        return view('admin.combos.create', compact('foods', 'drinks'));
    }

    // Xử lý lưu combo mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'foods' => 'required|array',
            'drinks' => 'nullable|array', // Không bắt buộc
        ]);

        // Tạo combo mới
        $combo = Combo::create($request->only(['name', 'price']));

        // Gắn món ăn
        $combo->foods()->attach($request->foods);

        // Gắn đồ uống nếu có
        if (isset($request->drinks) && !empty($request->drinks)) {
            foreach ($request->drinks as $drinkId) {
                ComboFoodDrink::create([
                    'combo_id' => $combo->id,
                    'food_id' => null, // Hoặc bạn có thể xử lý theo cách khác nếu cần
                    'drink_id' => $drinkId,
                ]);
            }
        }

        return redirect()->route('admin.combos.index')->with('success', 'Combo created successfully.');
    }

    // Hiển thị form chỉnh sửa combo
    public function edit($id)
    {
        $combo = Combo::with('foods', 'drinks')->findOrFail($id);
        $foods = Food::all();
        $drinks = Drink::all();
        return view('admin.combos.edit', compact('combo', 'foods', 'drinks'));
    }

    // Xử lý cập nhật combo
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'foods' => 'required|array',
            'drinks' => 'nullable|array', // Có thể không chọn đồ uống
        ]);

        // Tìm combo theo ID
        $combo = Combo::findOrFail($id);

        // Cập nhật thông tin combo
        $combo->update($request->only(['name', 'price']));

        // Cập nhật món ăn
        $combo->foods()->sync($request->foods); // Cập nhật hoặc gán lại món ăn

        // Cập nhật đồ uống
        if (isset($request->drinks) && !empty($request->drinks)) {
            $combo->drinks()->sync($request->drinks); // Cập nhật hoặc gán lại đồ uống
        } else {
            $combo->drinks()->detach(); // Nếu không có đồ uống, xóa tất cả đồ uống liên quan
        }

        return redirect()->route('admin.combos.index')->with('success', 'Combo updated successfully.');
    }

    // Xử lý xóa combo
    public function destroy($id)
    {
        $combo = Combo::findOrFail($id);
        $combo->foods()->detach();
        $combo->drinks()->detach();
        $combo->delete();

        return redirect()->route('admin.combos.index')->with('success', 'Combo deleted successfully.');
    }
}
