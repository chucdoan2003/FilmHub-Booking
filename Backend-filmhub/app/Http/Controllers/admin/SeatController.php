<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Http\Requests\StoreSeatRequest;
use App\Http\Requests\UpdateSeatRequest;
use App\Models\Room;
use App\Models\Row;
use App\Models\Type;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = "admin.seats.";
    public function index()
    {
        $data = Seat::query()->get();
        $rooms = Room::query()->pluck('room_name', 'room_id')->all();
        $rows = Row::query()->pluck('row_name', 'row_id')->all();
        $types = Type::query()->pluck('type_name', 'type_id')->all();

        return view(self::PATH_VIEW.__FUNCTION__, compact('data', 'rooms', 'rows', 'types',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::query()->pluck('room_name', 'room_id')->all();
        $rows = Row::query()->pluck('row_name', 'row_id')->all();
        $types = Type::query()->pluck('type_name', 'type_id')->all();

        return view(self::PATH_VIEW.__FUNCTION__, compact('rooms', 'rows', 'types'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSeatRequest $request)
    {
        $request->validate([
            'seat_number'=>['required'],
            'room_id'=>['required'],
            'row_id'=>['required'],
            'type_id'=>['required'],
            'status'=>['required', 'in:available,booked']
        ]);
        $data = $request->all();
        Seat::query()->create($data);
        return redirect()->route('admin.seats.index')->with('success', 'Thêm mới thành công');

    }

    /**
     * Display the specified resource.
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seat $seat)
    {
        $rooms = Room::query()->pluck('room_name', 'room_id')->all();
        $rows = Row::query()->pluck('row_name', 'row_id')->all();
        $types = Type::query()->pluck('type_name', 'type_id')->all();
        return view(self::PATH_VIEW.__FUNCTION__, compact('seat', 'rooms', 'rows', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeatRequest $request, Seat $seat)
    {
        $request->validate([
            'seat_number'=>['required'],
            'room_id'=>['required'],
            'row_id'=>['required'],
            'type_id'=>['required'],
            'status'=>['required', 'in:available,booked']
        ]);
        $data = $request->all();
        $seat->update($data);
        return redirect()->route('admin.seats.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat)
    {
        $seat->delete();
        return back()->with('success', 'Xóa thành công');
    }
    public function filterSeatByRoom($room_id){
        $seats = Seat::query()->where('room_id', $room_id)->get();
        $rooms = Room::query()->pluck('room_name', 'room_id')->all();
        $roomName = Room::query()->where('room_id', $room_id)->first();
        return view(self::PATH_VIEW.__FUNCTION__, compact('seats', 'roomName', 'rooms'));
    }
}
