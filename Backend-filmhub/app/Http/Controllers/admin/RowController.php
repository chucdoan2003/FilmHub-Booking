<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Row;
use App\Http\Requests\StoreRowRequest;
use App\Http\Requests\UpdateRowRequest;
use App\Models\Room;

class RowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = "admin.rows.";
    public function index()
    {
        $data = Row::query()->get();
        $rooms = Room::query()->pluck('room_name', 'room_id')->all();
        return view(self::PATH_VIEW.__FUNCTION__, compact('data', 'rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::query()->pluck('room_name', 'room_id')->all();
        return view(self::PATH_VIEW.__FUNCTION__, compact('rooms'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRowRequest $request)
    {
        $request->validate([
            'row_name'=>['required'],
            'room_id'=>['required'],
        ]);
        $data = $request->all();
        // dd($request->all());
        Row::query()->create($data);
        return redirect()->route('admin.rows.index')->with('success', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Row $row)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Row $row)
    {
        $rooms = Room::query()->pluck('room_name', 'room_id')->all();
        return view(self::PATH_VIEW.__FUNCTION__, compact('row', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRowRequest $request, Row $row)
    {
        $request->validate([
            'row_name'=>['required'],
            'room_id'=>['required'],
        ]);
        $data = $request->all();
        $row->update($data);
        return redirect()->route('admin.rows.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Row $row)
    {
        $row->delete();
        return back()->with('success', 'Xóa thành công');
    }
}
