<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Http\Requests\StoreSeatRequest;
use App\Http\Requests\UpdateSeatRequest;
use App\Models\Room;
use App\Models\Row;
use App\Models\Type;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = "admin.seats.";
    public function index()
    {
        $data = Seat::query()->get();
        // dd($data->all());
        $rooms = Room::query()->pluck('room_name', 'room_id')->all();
        // $rows = Row::query()->pluck('row_name', 'row_id')->all();
        // $types = Type::query()->pluck('type_name', 'type_id')->all();

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
    public function createSeat(Request $request){
        // dd($request->all());
        $room_id = $request->input('room_id');
        $rooms = Room::with(['rows'])->where('room_id', $room_id)->firstOrFail();
        $rows = Row::query()->where('room_id', $room_id)->pluck('row_name', 'row_id')->all(); // Lấy hàng ghế cho phòng đã chọn
        $types = Type::query()->pluck('type_name', 'type_id')->all(); // Lấy loại ghế

        return view(self::PATH_VIEW.__FUNCTION__, compact('rooms', 'rows', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSeatRequest $request)
{
    $request->validate([
        'room_id' => ['required'],
        'row_id' => ['required'],
        'type_id' => ['required'],
        'status' => ['required', 'in:available,booked'],
        'seat_quantity' => ['required', 'integer', 'min:1'],
    ]);

    $quantity = $request->input('seat_quantity');
    $room_id = $request->input('room_id');
    $row_id = $request->input('row_id');
    $type_id = $request->input('type_id');
    $status = $request->input('status');

    // Lấy tên hàng ghế
    $row_name = Row::find($row_id)->row_name;

    // Lấy số ghế hiện có trong hàng ghế
     // Lấy số ghế hiện có trong bảng seats cho phòng và hàng ghế đã chọn
     $existingSeatsCount = Seat::where('room_id', $room_id)
     ->where('row_id', $row_id)
     ->count();

    for ($i = 0; $i < $quantity; $i++) {
        // Tạo số ghế mới
        $newSeatNumber = $row_name . ($existingSeatsCount + $i + 1);

        // Tạo ghế
        Seat::create([
            'seat_number' => $newSeatNumber,
            'room_id' => $room_id,
            'row_id' => $row_id,
            'type_id' => $type_id,
            'status' => $status,
        ]);
    }

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
        $room_id = $seat->room_id;
        $rooms = Room::query()->pluck('room_name', 'room_id')->all();
        $rows = Row::query()->where('room_id', $room_id)->pluck('row_name', 'row_id')->all();
        $types = Type::query()->pluck('type_name', 'type_id')->all();
        return view(self::PATH_VIEW.__FUNCTION__, compact('seat', 'rooms', 'rows', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeatRequest $request, Seat $seat)
    {
        // dd($request->all());
        $request->validate([
            'seat_number'=>['required'],
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
    // lọc ghế theo phòng
    public function filterSeatByRoom($room_id){
        $seats = Seat::query()->where('room_id', $room_id)->get();
        $rooms = Room::query()->pluck('room_name', 'room_id')->all();
        $roomName = Room::query()->where('room_id', $room_id)->first();
        return view(self::PATH_VIEW.__FUNCTION__, compact('seats', 'roomName', 'rooms'));
    }
}
