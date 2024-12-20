<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Theater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Shift;
use App\Models\Room;
use App\Models\Seat;
use Illuminate\Support\Facades\Log;

class AdminTheaterController extends Controller
{
    const PATH_VIEW = 'admin.theaters.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Theater::query()->withCount(['rooms'])->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return view for creating new theater (admin form).
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            // 'number_of_rooms' => 'required|integer|min:1',
            // 'number_of_shifts' => 'required|integer|min:1',
            // 'shift_start_time' => 'required|array',
            // 'shift_start_time.*' => 'date_format:H:i',
            // 'shift_end_time' => 'required|array',
            // 'shift_end_time.*' => 'date_format:H:i',
        ]);

        // Lưu theater
        $theater = Theater::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        // // Thêm phòng vào bảng rooms
        // for ($i = 1; $i <= $request->number_of_rooms; $i++) {
        //     $room_name = 'Phòng ' . $i; // Tạo tên phòng
        //     $theater->rooms()->create([
        //         'room_name' => $room_name,

        //     ]);
        // }

        // // Lưu thời gian ca chiếu vào bảng shifts
        // for ($i = 1; $i <= $request->number_of_shifts; $i++) {
        //     $shift_name = 'Ca ' . $i; // Tên ca chiếu
        //     $theater->shifts()->create([
        //         'start_time' => $request->shift_start_time[$i - 1],
        //         'end_time' => $request->shift_end_time[$i - 1],
        //         'shift_name' => $shift_name,
        //     ]);
        // }

        return redirect()->route('admin.theaters.index')->with('success', 'Thêm mới rạp thành công');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $theater = Theater::with('rooms')->findOrFail($id);


        return view('admin.theaters.show', compact('theater'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Theater $theater)
    {
        $shifts = $theater->shifts;
        $rooms = $theater->rooms;
        $roomsCount = $theater->rooms()->count();
        return view('admin.theaters.edit', compact('theater', 'shifts', 'rooms', 'roomsCount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Theater $theater)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);



        // Cập nhật tên và địa điểm rạp
        $theater->update([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        // $currentRoomCount = $theater->rooms()->count();
        // $newRoomCount = $request->number_of_rooms;

        // if ($newRoomCount != $currentRoomCount) {
        //     // Xóa tất cả các phòng hiện tại
        //     $theater->rooms()->delete();

        //     // Thêm các phòng mới
        //     for ($i = 0; $i < $newRoomCount; $i++) {
        //         $room_name = 'Phòng ' . ($i + 1);
        //         $theater->rooms()->create([
        //             'room_name' => $room_name,
        //             'theater_id' => $theater->theater_id,
        //         ]);
        //     }
        // }




        // // Cập nhật ca chiếu
        // $currentShiftCount = $theater->shifts()->count();
        // $newShiftCount = $request->number_of_shifts;

        // // Nếu số lượng ca chiếu mới khác với số lượng hiện tại
        // if ($newShiftCount != $currentShiftCount) {
        //     // Xóa các ca cũ
        //     $theater->shifts()->delete();

        //     // Thêm ca chiếu mới
        //     for ($i = 0; $i < $newShiftCount; $i++) {
        //         $shift_name = 'Ca ' . ($i + 1); // Tên ca chiếu
        //         $theater->shifts()->create([
        //             'start_time' => $request->shift_start_time[$i],
        //             'end_time' => $request->shift_end_time[$i],
        //             'shift_name' => $shift_name,
        //         ]);
        //     }
        // }

        return redirect()->route('admin.theaters.index')->with('success', 'Cập nhật rạp thành công');


    }










    public function indexRoom()
    {
        $theaters = Theater::with('rooms')->get();
        return view('admin.theaters.indexRoom', compact('theaters'));
    }
    public function createRoom()
    {
        $theaters = Theater::all();
        return view('admin.theaters.createRoom', compact('theaters'));
    }
    public function storeRoom(Request $request)
{
    $request->validate([
        'room_name' => 'required|string|max:255',
        'theater_id' => 'required|exists:theaters,theater_id',
    ]);

    // Tạo phòng
     Room::create([
        'room_name' => $request->room_name,
        'theater_id' => $request->theater_id,
    ]);


    return redirect()->route('theaters.createRoom')->with('success', 'Thêm phòng và ghế thành công');
}

    public function destroyRoom(Room $room)
    {
        $room->delete();
        return redirect()->route('theaters.indexRoom')->with('success', 'Xóa phòng thành công');
    }

    public function editRoom($id)
    {
        $room = Room::findOrFail($id);
        $theaters = Theater::pluck('name', 'theater_id')->toArray();
        return view('admin.theaters.editRoom', compact('room', 'theaters'));
    }

    public function updateRoom(Request $request, $id)
    {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'theater_id' => 'required|exists:theaters,theater_id',
        ]);

        $room = Room::findOrFail($id);
        $room->update([
            'room_name' => $request->room_name,
            'theater_id' => $request->theater_id, // Cập nhật rạp
        ]);

        return redirect()->route('theaters.indexRoom')->with('success', 'Cập nhật phòng thành công!');
    }







    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theater $theater)
{
    // Lấy thời gian hiện tại
    $currentDateTime = now();

    // Kiểm tra xem có showtimes nào đang diễn ra hoặc sắp chiếu không
    $hasActiveShowtimes = $theater->shifts()
        ->whereHas('showtimes', function ($query) use ($currentDateTime) {
            $query->where(function ($subQuery) use ($currentDateTime) {
                $subQuery->whereRaw("TIMESTAMP(datetime, shifts.start_time) <= ?", [$currentDateTime]) // Ca chiếu bắt đầu
                         ->whereRaw("TIMESTAMP(datetime, shifts.end_time) > ?", [$currentDateTime]);  // Ca chiếu chưa kết thúc
            })
            ->orWhere(function ($subQuery) use ($currentDateTime) {
                $subQuery->whereRaw("TIMESTAMP(datetime, shifts.start_time) > ?", [$currentDateTime]); // Ca chiếu sắp diễn ra
            });
        })
        ->exists();

    if ($hasActiveShowtimes) {
        return redirect()->route('admin.theaters.index')
            ->with('error', 'Không thể xóa rạp vì có ca chiếu đang diễn ra hoặc sắp diễn ra.');
    }
    dd( $hasActiveShowtimes)

    // Xóa các phòng liên quan đến rạp
    // $theater->rooms()->delete();

    // Xóa rạp
    // $theater->delete();

    return redirect()->route('admin.theaters.index')->with('success', 'Xóa rạp và phòng thành công.');
}
}
