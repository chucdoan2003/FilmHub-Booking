<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Theater;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = "admin.rooms.";
    public function index()
    {
        $data = Room::query()->get();
        $theaters = Theater::query()->pluck('name', 'theater_id')->all();
        return view(self::PATH_VIEW.__FUNCTION__, compact('data', 'theaters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $theaters = Theater::query()->pluck('name', 'theater_id')->all();
        return view(self::PATH_VIEW.__FUNCTION__, compact('theaters'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        $request->validate([
            'room_name'=>['required'],
            'theater_id'=>['required'],
        ]);
        $data = $request->all();
        Room::query()->create($data);
        return redirect()->route('admin.rooms.index')->with('success', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $theaters = Theater::query()->pluck('name', 'theater_id')->all();
        return view(self::PATH_VIEW.__FUNCTION__, compact('theaters', 'room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        
        $request->validate([
            'room_name'=>['required'],
            'theater_id'=>['required'],
        ]);
        $data = $request->all();
        $room->update($data);
        return redirect()->route('admin.rooms.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return back()->with('success', 'Xóa thành công');
    }
}
