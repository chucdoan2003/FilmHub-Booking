<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Row;
use App\Http\Requests\StoreRowRequest;
use App\Http\Requests\UpdateRowRequest;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = "admin.rows.";
    public function index()
    {
        $theater_id = session('theater_id'); // Lấy theater_id từ session
        $data = Row::leftJoin('rooms', 'rows.room_id', '=', 'rooms.room_id')
        ->where('rooms.theater_id', $theater_id) // Lọc theo theater_id
        ->select('rows.*', 'rooms.room_name')
        ->get();
        return view(self::PATH_VIEW.__FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $theater_id = session('theater_id'); // Lấy theater_id từ session
        $rooms = Room::query()
        ->where('theater_id', $theater_id) // Lọc các phòng theo theater_id
        ->pluck('room_name', 'room_id')
        ->all();
        return view(self::PATH_VIEW.__FUNCTION__, compact('rooms'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRowRequest $request)
    {
        $request->validate([
            'row_name'=>['required'],
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
        $showtime = DB::table('rows')
        ->join('rooms', 'rows.room_id', '=', 'rooms.room_id') // Join để lấy thông tin phòng
        ->join('showtimes', 'rooms.room_id', '=', 'showtimes.room_id') // Join để lấy thông tin ca chiếu
        ->where('rows.room_id', $row->room_id) // Lọc theo ghế hiện tại
        ->select('showtimes.showtime_id','showtimes.datetime', 'rows.row_name','rooms.room_name')
        ->first();
        // dd($currentDate, $currentTime);
        if(!$showtime){
            $theater_id = session('theater_id'); // Lấy theater_id từ session
            $rooms = Room::query()
            ->where('theater_id', $theater_id) // Lọc các phòng theo theater_id
            ->pluck('room_name', 'room_id')
            ->all();
            return view(self::PATH_VIEW.__FUNCTION__, compact('row', 'rooms'));
        }
         // Kiểm tra thời gian
        else {
            return redirect()->route('admin.rows.index')->with('error', 'Không thể sửa hàng ghế khi có ca chiếu');
        }
        
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
        $showtime = DB::table('rows')
        ->join('rooms', 'rows.room_id', '=', 'rooms.room_id') // Join để lấy thông tin phòng
        ->join('showtimes', 'rooms.room_id', '=', 'showtimes.room_id') // Join để lấy thông tin ca chiếu
        ->where('rows.room_id', $row->room_id) // Lọc theo ghế hiện tại
        ->select('showtimes.showtime_id','showtimes.datetime', 'rows.row_name','rooms.room_name')
        ->first();
        if(!$showtime){
            $row->delete();
            return back()->with('success', 'Xóa thành công');
        }else{
            return redirect()->route('admin.rows.index')->with('error', 'Không thể xóa hàng ghế khi có ca chiếu');
        }
       
    }
}
