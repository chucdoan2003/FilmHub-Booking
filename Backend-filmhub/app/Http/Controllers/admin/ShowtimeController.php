<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Room;
use App\Models\Shift;
use App\Models\Showtime;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    public function index()
    {
        $showtimes = Showtime::with(['movie', 'room', 'shift'])->get(); // Giả sử bạn đã thiết lập quan hệ trong model

        return view('admin.showtimes.index', compact('showtimes'));
    }

    // Hiển thị form tạo mới
    public function create()
    {
        $movies = Movie::all(); // Lấy tất cả các movie
        $rooms = Room::all();   // Lấy tất cả các rooms
        $shifts = Shift::all(); // Lấy tất cả các shifts
        return view('admin.showtimes.create', compact('movies', 'rooms', 'shifts'));
    }

    // Lưu showtime mới
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'movie_id' => 'required|exists:movies,movie_id',
    //         'room_id' => 'required|exists:rooms,room_id',
    //         'shift_id' => 'required|exists:shifts,shift_id',
    //         'start_time' => 'required|date',
    //         'end_time' => 'required|date|after:start_time',
    //     ]);

    //     Showtime::create($request->all());
    //     return redirect()->route('admin.showtimes.index')->with('success', 'Showtime created successfully.');
    // }

    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'movie_id' => 'required|exists:movies,movie_id',
            'room_id' => 'required|exists:rooms,room_id',
            'shift_id' => 'required|exists:shifts,shift_id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Kiểm tra xem showtime đã tồn tại chưa
        $exists = Showtime::where('movie_id', $request->movie_id)
            ->where('room_id', $request->room_id)
            ->where('shift_id', $request->shift_id)
            ->where('start_time', $request->start_time)
            ->where(function ($query) use ($request) {
                $query->where('start_time', '<', $request->end_time)
                    ->where('end_time', '>', $request->start_time);
            })
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['The selected movie, room, and shift combination already exists.'])
                ->withInput();
        }

        // Tạo showtime mới
        Showtime::create($request->all());

        return redirect()->route('admin.showtimes.index')->with('success', 'Showtime created successfully.');
    }

    // Hiển thị form chỉnh sửa
    public function edit($showtime_id)
    {
        $showtime = Showtime::findOrFail($showtime_id);

        $movies = Movie::all();
        $rooms = Room::all();
        $shifts = Shift::all();
        return view('admin.showtimes.edit', compact('showtime', 'movies', 'rooms', 'shifts'));
    }

    // Cập nhật showtime
    public function update(Request $request, $showtime_id)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,movie_id',
            'room_id' => 'required|exists:rooms,room_id',
            'shift_id' => 'required|exists:shifts,shift_id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $showtime = Showtime::findOrFail($showtime_id);
        $showtime->update($request->all());
        return redirect()->route('admin.showtimes.index')->with('success', 'Showtime updated successfully.');
    }

    // Xóa showtime
    public function destroy($showtime_id)
    {
        $showtime = Showtime::findOrFail($showtime_id);
        $showtime->delete();
        return redirect()->route('admin.showtimes.index')->with('success', 'Showtime deleted successfully.');
    }
}
