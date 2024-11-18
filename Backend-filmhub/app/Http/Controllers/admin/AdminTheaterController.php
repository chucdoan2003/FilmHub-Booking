<?php

namespace App\Http\Controllers\Admin;

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
           
        ]);

        // Lưu theater
        $theater = Theater::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);

       

        return redirect()->route('admin.theaters.index')->with('success', 'Thêm mới rạp thành công');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $theater = Theater::with('rooms')->findOrFail($id);
        $shifts = Shift::where('theater_id', $id)->get();

        return view('admin.theaters.show', compact('theater', 'shifts'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Theater $theater)
    {
       
        $rooms = $theater->rooms;
        $roomsCount = $theater->rooms()->count();
        return view('admin.theaters.edit', compact('theater', 'rooms', 'roomsCount'));
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
            'capacity' => 'required|integer|min:1',
        ]);



        $room = Room::create([
            'room_name' => $request->room_name,
            'theater_id' => $request->theater_id,
            'capacity' => $request->capacity,
        ]);


        for ($i = 1; $i <= $request->capacity; $i++) {
            Seat::create([
                'room_id' => $room->room_id,
                'seat_number' => $i,

            ]);
        }


        return redirect()->route('theaters.createRoom')->with('success', 'Thêm phòng thành công');
    }

    public function destroyRoom(Room $room)
    {
        $room->delete();
        return redirect()->route('theaters.indexRoom')->with('success', 'Xóa phòng thành công');
    }

    public function editRoom($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.theaters.editRoom', compact('room'));
    }

    public function updateRoom(Request $request, $id)
    {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        $room = Room::findOrFail($id);
        $room->update([
            'room_name' => $request->room_name,
            'capacity' => $request->capacity,
        ]);

        return redirect()->route('theaters.indexRoom')->with('success', 'Cập nhật phòng thành công!');
    }







    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theater $theater)
    {
        try {
            DB::beginTransaction();

            // Xóa các phòng và các ca của rạp
            $theater->rooms()->delete();
            $theater->shifts()->delete();

            // Xóa rạp
            $theater->delete();

            DB::commit();
            return redirect()->route('admin.theaters.index')->with('success', 'Xóa rạp thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}