<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ShowtimesController extends Controller
{
    function addshowtimes(Request $request) {}
    function list()
    {
        $showtimes = DB::table('showtimes')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
            ->join('rooms', 'showtimes.room_id', '=', 'rooms.room_id')   // Join với bảng rooms
            ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id') // Join với bảng shifts
            ->select('showtimes.*', 'movies.title as movie_name', 'rooms.room_name as room_name', 'shifts.shift_name as shift_name', 'showtimes.start_time', 'showtimes.end_time', 'showtimes.value')
            ->paginate(10);
        return view('admin.showtimes.list', compact('showtimes'));
    }
    function create()
    {
        return view('admin.showtimes.add');
    }
    public function create2(Request $request)
    {

        $start_time = $request->start_time ?? null;
        $end_time = $request->end_time ?? null;

        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();


        $showtimes = DB::table('showtimes')
            ->select('room_id', DB::raw('COUNT(*) as total_showtimes'))
            ->where(function ($query) use ($start_time, $end_time) {
                $query->whereBetween('start_time', [$start_time, $end_time])
                    ->orWhereBetween('end_time', [$start_time, $end_time]);
            })
            ->groupBy('room_id')
            ->get();

        $room_over = [];
        foreach ($showtimes as $item) {
            if ($item->total_showtimes == count($shifts)) {
                $room_over[] = $item->room_id;
            }
        }

        return view('admin.showtimes.add2', compact('movies', 'rooms', 'start_time', 'end_time', 'room_over'));
    }



    public function store(Request $request)
    {


        $movie_id = $request->movie;
        $room_id = $request->room;
        $start_time = $request->start_time;
        $end_time = $request->end_time;

        // Kiểm tra lịch chiếu
        $showtimes = DB::table('showtimes')
            ->where('room_id', $room_id)
            ->where(function ($query) use ($start_time, $end_time) {
                $query->whereBetween('start_time', [$start_time, $end_time])
                    ->orWhereBetween('end_time', [$start_time, $end_time]);
            })
            ->get();

        $shiftInroomBook = [];
        foreach ($showtimes as $item) {
            $shiftInroomBook[] = $item->shift_id;
        }

        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();

        return view('admin.showtimes.addshift', compact('movies', 'rooms', 'shifts', 'movie_id', 'room_id', 'start_time', 'end_time', 'shiftInroomBook'));
    }



    function addshowtime(Request $request)
    {
        $shift_id = $request->shift;
        $movie_id = $request->movie;
        $room_id = $request->room;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $value = $request->value;


        DB::table('showtimes')->insert([
            "movie_id" => $movie_id,
            "room_id" => $room_id,
            "shift_id" => $shift_id,
            "start_time" => $start_time,
            "end_time" => $end_time,
            "value" => $value,
            "created_at" => Carbon::now()
        ]);




        return redirect()->route('showtimes.create')->with('success', 'Lịch chiếu đã được tạo thành công!');
    }


    function destroy(string $id)
    {
        DB::table('showtimes')->where('id', $id)->delete();
        return redirect()->route('showtimes.index');
    }
    function edit(string $id)
    {
        $showtime = DB::table('showtimes')->where('showtime_id', $id)->first(); // Sửa ở đây
        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();

        // Sử dụng start_time thay vì datetime
        $showtimes = DB::table('showtimes')
            ->select('room_id', DB::raw('COUNT(*) as total_showtimes'))
            ->whereDate('start_time', $showtime->start_time) // Sửa ở đây
            ->groupBy('room_id')
            ->get();

        // Kiểm tra phòng full ca chưa
        $room_over = [];
        foreach ($showtimes as $item) {
            if ($item->total_showtimes == count($shifts)) {
                $room_over[] = $item->room_id;
            }
        }

        // Kiểm tra phòng chọn những ca nào
        $showtimes2 = DB::table('showtimes')
            ->whereDate('start_time', $showtime->start_time) // Sửa ở đây
            ->where('room_id', $showtime->room_id)
            ->get();

        $shiftInroomBook = [];
        foreach ($showtimes2 as $item) {
            $shiftInroomBook[] = $item->shift_id;
        }

        return view('admin.showtimes.edit', compact('showtime', 'movies', 'shifts', 'rooms', 'room_over', 'shiftInroomBook'));
    }
    function update(string $id, Request $request,)
    {
        try {

            $update = DB::table('showtimes')->where('showtime_id', $id)->update([
                "movie_id" => $request->movie,
                "room_id" => $request->room,
                "shift_id" => $request->shift,
                "start_time" => $request->start_time,
                "end_time" => $request->end_time
            ]);

            return redirect()->route('showtimes.index')->with('success', 'Lịch chiếu đã được cập nhật thành công!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Cập nhật thất bại, vui lòng thử lại!')->withInput();
        }
    }
    function getAPI(Request $request)
    {
        $showtimes = DB::table('showtimes')->get();

        return response()->json([
            "message" => "get data success",
            "data" => $showtimes
        ]);
    }
}
