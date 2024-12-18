<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Row;
use App\Models\Theater;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = "admin.rooms.";
    public function index()
    {
        $theater_id = session('theater_id'); // Lấy theater_id từ session
        $data = Room::query()->where('theater_id', $theater_id)->get();
        $theaters = Theater::query()->where('theater_id', $theater_id)->pluck('name', 'theater_id')->all();
        // dd($theaters);
        return view(self::PATH_VIEW.__FUNCTION__, compact('data', 'theaters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $theater_id = session('theater_id'); // Lấy theater_id từ session
        $theaters = Theater::query()->where('theater_id', $theater_id)->first();
        return view(self::PATH_VIEW.__FUNCTION__, compact('theaters'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        $request->validate([
            'room_name' => ['required'],

        ]);

        $data = $request->all();
        $room = Room::query()->create($data); // Tạo phòng mới
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
        $showtime = DB::table('rooms')
        ->join('showtimes', 'rooms.room_id', '=', 'showtimes.room_id') // Join để lấy thông tin ca chiếu
        ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id') // Join để lấy thông tin ca làm việc
        ->where('rooms.room_id', $room->room_id) // Lọc theo phòng hiện tại
        ->select('showtimes.showtime_id','showtimes.datetime', 'shifts.start_time', 'shifts.end_time', 'rooms.room_id', 'rooms.room_name')
        ->first();
        // dd($showtime);
        // Lấy thời gian hiện tại
        $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh'); // Lấy thời gian hiện tại theo múi giờ Hồ Chí Minh
        $currentDate = $currentDateTime->format('Y-m-d');
        $currentTime = $currentDateTime->format('H:i:s');
        // dd($currentDate, $currentTime);
         // Kiểm tra thời gian
         if(!$showtime || !($currentDate == $showtime->datetime && $showtime->start_time <= $currentTime && $currentTime <= $showtime->end_time)){
            $theater_id = session('theater_id'); // Lấy theater_id từ session
            $theaters = Theater::query()->where('theater_id', $theater_id)->first();
            return view(self::PATH_VIEW.__FUNCTION__, compact('theaters', 'room'));
        }
        elseif( $currentDate == $showtime->datetime && $showtime->start_time <= $currentTime && $currentTime <= $showtime->end_time) {
            return redirect()->route('admin.rooms.index')->with('error', 'Không thể sửa phòng trong ca chiếu đang diễn ra.');
        }
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
