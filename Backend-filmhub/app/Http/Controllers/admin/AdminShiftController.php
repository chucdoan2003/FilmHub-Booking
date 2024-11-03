<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminShiftController extends Controller
{
    // Hiển thị danh sách tất cả shifts
    public function index()
    {
        $shifts = Shift::all();
        return view('admin.shifts.index', compact('shifts'));
    }

    // Hiển thị form tạo một shift mới
    public function create()
    {
        return view('admin.shifts.create');
    }

    // Lưu shift mới
    public function store(Request $request)
    {
        $request->validate([
            'shift_name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        Shift::create($request->all());
        return redirect()->route('admin.shifts.index')->with('success', 'Shift created successfully.');
    }

    // Hiển thị thông tin chi tiết một shift
    public function show($shift_id)
    {
        $shift = Shift::findOrFail($shift_id);
        return view('admin.shifts.show', compact('shift'));
    }

    // Hiển thị form chỉnh sửa một shift
    public function edit($shift_id)
    {
        $shift = Shift::findOrFail($shift_id);
        return view('admin.shifts.edit', compact('shift'));
    }

    // Cập nhật thông tin một shift
    public function update(Request $request, $shift_id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'shift_name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        try {
            // Tìm shift theo ID
            $shift = Shift::findOrFail($shift_id);

            // Cập nhật shift
            $shift->update($request->only(['shift_name', 'start_time', 'end_time']));

            // Chuyển hướng về danh sách với thông báo thành công
            return redirect()->route('admin.shifts.index')->with('success', 'Shift updated successfully.');
        } catch (\Exception $e) {
            // Ghi log lỗi
            Log::error('Error updating shift: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Có lỗi xảy ra khi cập nhật.']);
        }
    }

    // Xóa một shift
    public function destroy($shift_id)
    {
        $shift = Shift::findOrFail($shift_id);
        $shift->delete();
        return redirect()->route('admin.shifts.index')->with('success', 'Shift deleted successfully.');
    }
}
