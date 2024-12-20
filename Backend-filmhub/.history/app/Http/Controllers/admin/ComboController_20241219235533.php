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
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'total-price' => 'required|numeric|min:0',
            'foods' => 'required|array', // Món ăn là bắt buộc
            'drinks' => 'nullable|array', // Đồ uống không bắt buộc
        ]);

        // Lấy giá từ input
        $totalPrice = $request->input('total-price');

        // Tạo combo mới và lưu giá trị price
        $combo = Combo::create([
            'name' => $request->name,
            'price' => $totalPrice, // Lưu giá trị price từ input
        ]);

        // Gắn món ăn
        $combo->foods()->attach($request->foods);

        // Gắn đồ uống nếu có
        if (!empty($request->drinks)) {
            foreach ($request->drinks as $drinkId) {
                ComboFoodDrink::create([
                    'combo_id' => $combo->id,
                    'food_id' => null, // Không có food_id, chỉ gán drink_id
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
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'total-price' => 'required|numeric|min:0', // Thêm xác thực cho total-price
            'foods' => 'required|array', // Món ăn là bắt buộc
            'drinks' => 'nullable|array', // Đồ uống không bắt buộc
        ]);

        // Tìm combo theo ID
        $combo = Combo::findOrFail($id);

        // Cập nhật tên combo
        $combo->name = $request->name;

        // Lấy giá từ input
        $combo->price = $request->input('total-price'); // Cập nhật giá từ input

        // Cập nhật món ăn
        $combo->foods()->sync($request->foods); // Đồng bộ món ăn mới

        // Cập nhật đồ uống nếu có
        if (!empty($request->drinks)) {
            // Đồng bộ đồ uống mới
            $combo->drinks()->sync($request->drinks); // Đồng bộ đồ uống
        } else {
            // Nếu không có đồ uống, xóa tất cả đồ uống liên quan
            $combo->drinks()->detach();
        }

        // Lưu thay đổi
        $combo->save();

        return redirect()->route('admin.combos.index')->with('success', 'Combo sửa thành công.');
    }

    // Xử lý xóa combo
    public function destroy($id)
    {
        $combo = Combo::findOrFail($id);
        // Kiểm tra xem có vé nào liên quan đến combo không
        if ($combo->tickets()->exists()) {
        return redirect()->route('admin.combos.index')->with('error', 'Không thể xóa combo vì đã có vé liên quan.');
        }
        $combo->foods()->detach();
        $combo->drinks()->detach();
        $combo->delete();

        return redirect()->route('admin.combos.index')->with('success', 'Xóa thành công.');
    }
}
