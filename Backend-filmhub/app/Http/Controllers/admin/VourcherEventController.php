<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VourcherEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VourcherEventController extends Controller
{
    public function index()
    {
        $events =DB::table('vourcher_event')->latest()->paginate(5);
        return view('admin.vourcher-event.index', compact('events'));
    }

    // Hiển thị form tạo sự kiện mới
    public function create()
    {
        return view('admin.vourcher-event.add');
    }

    // Lưu sự kiện mới
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'discount_percentage' => 'nullable|numeric',
            'max_discount_amount' => 'nullable|numeric',
            'vourcher_code' => 'nullable|string|max:255',
            'vourcher_name' => 'nullable|string|max:255',
        ]);

        VourcherEvent::create($request->all());
        return redirect()->route('vourcher-events.index')->with('success', 'Sự kiện đã được tạo thành công.');
    }

    // Hiển thị form chỉnh sửa sự kiện
    public function edit(VourcherEvent $vourcherEvent)
    {
        return view('admin.vourcher-event.edit', compact('vourcherEvent'));
    }

    // Cập nhật sự kiện
    public function update(Request $request, VourcherEvent $vourcherEvent)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'discount_percentage' => 'nullable|numeric',
            'max_discount_amount' => 'nullable|numeric',
            'vourcher_code' => 'nullable|string|max:255',
            'vourcher_name' => 'nullable|string|max:255',
        ]);

        $vourcherEvent->update($request->all());
        return redirect()->route('vourcher-events.index')->with('success', 'Sự kiện đã được cập nhật thành công.');
    }

    // Xóa sự kiện
    public function destroy(VourcherEvent $vourcherEvent)
    {
        $vourcherEvent->delete();
        return redirect()->route('vourcher-events.index')->with('success', 'Sự kiện đã được xóa thành công.');
    }
}
