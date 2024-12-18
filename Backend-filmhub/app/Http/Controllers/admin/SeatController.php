<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Http\Requests\StoreSeatRequest;
use App\Http\Requests\UpdateSeatRequest;
use App\Models\Room;
use App\Models\Row;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = "admin.seats.";
    public function index()
    {
        $theater_id = session('theater_id'); // Lấy theater_id từ session
        $data = Seat::with(['rooms', 'rows', 'types']) // Eager load các mối quan hệ
        ->whereHas('rooms', function($query) use ($theater_id) {
            $query->where('theater_id', $theater_id); // Lọc ghế theo theater_id
        })
        ->get();
        // dd($data->all());
        $rooms = Room::query()
        ->where('theater_id', $theater_id) // Lọc các phòng theo theater_id
        ->pluck('room_name', 'room_id')
        ->all();

        return view(self::PATH_VIEW.__FUNCTION__, compact('data', 'rooms'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $theater_id = session('theater_id'); // Lấy theater_id từ sessions
        $theater = DB::table('theaters')->where('theater_id', $theater_id)->first();
        $rooms = Room::query()
        ->where('theater_id', $theater_id) // Lọc phòng theo theater_id
        ->pluck('room_name', 'room_id')
        ->all();
        return view(self::PATH_VIEW.__FUNCTION__, compact('rooms', 'theater'));

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
//    dd($request->all());
    if($request->input('seat_quantity') == null){
        return back()->with('error', 'Vui lòng nhập số lượng ghế');
    } 
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
        $showtime = DB::table('seats')
        ->join('rooms', 'seats.room_id', '=', 'rooms.room_id') // Join để lấy thông tin phòng
        ->join('showtimes', 'rooms.room_id', '=', 'showtimes.room_id') // Join để lấy thông tin ca chiếu
        ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id') // Join để lấy thông tin ca làm việc
        ->where('seats.seat_id', $seat->seat_id) // Lọc theo ghế hiện tại
        ->select('showtimes.showtime_id','showtimes.datetime', 'shifts.start_time', 'shifts.end_time','seats.seat_number','rooms.room_name')
        ->first();
        // dd($showtime);
        //  dd($showtime->datetime);
        // Lấy thời gian hiện tại
        $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh'); // Lấy thời gian hiện tại theo múi giờ Hồ Chí Minh
        $currentDate = $currentDateTime->format('Y-m-d');
        $currentTime = $currentDateTime->format('H:i:s');
        // dd($currentDate, $currentTime);
        if(!$showtime ||  !($currentDate == $showtime->datetime && $showtime->start_time <= $currentTime && $currentTime <= $showtime->end_time)){
            $theater_id = session('theater_id'); // Lấy theater_id từ session
            $rooms = Room::query()
            ->where('theater_id', $theater_id) // Lọc phòng theo theater_id
            ->pluck('room_name', 'room_id')
            ->all();
            $rows = Row::query()->where('room_id', $seat->room_id)->pluck('row_name', 'row_id')->all();
            $types = Type::query()->pluck('type_name', 'type_id')->all();
            return view(self::PATH_VIEW.__FUNCTION__, compact('seat', 'rooms', 'rows', 'types'));
        }
         // Kiểm tra thời gian
        elseif( $currentDate == $showtime->datetime && $showtime->start_time <= $currentTime && $currentTime <= $showtime->end_time) {
            return redirect()->route('admin.seats.index')->with('error', 'Không thể sửa ghế trong ca chiếu đang diễn ra.');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeatRequest $request, Seat $seat)
    {
        // dd($request->all());
        if($request->input('seat_number') == null){
            return back()->with('error', 'Vui lòng nhập số ghế');
        }
        $data = $request->all();
        $seat->update($data);
        return redirect()->route('admin.seats.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat)
    {
        $showtime = DB::table('seats')
        ->join('rooms', 'seats.room_id', '=', 'rooms.room_id') // Join để lấy thông tin phòng
        ->join('showtimes', 'rooms.room_id', '=', 'showtimes.room_id') // Join để lấy thông tin ca chiếu
        ->where('seats.seat_id', $seat->seat_id) // Lọc theo ghế hiện tại
        ->select('showtimes.showtime_id','showtimes.datetime', 'seats.seat_number','rooms.room_name')
        ->first();
        if(!$showtime){
            $seat->delete();
            return back()->with('success', 'Xóa thành công');
        } else{
            return redirect()->route('admin.seats.index')->with('error', 'Không thể xóa ghế đã có ca chiếu');
        }
       
    }
    // lọc ghế theo phòng
    public function filterSeatByRoom($room_id){
        $seats = Seat::query()->where('room_id', $room_id)->get();
        $rooms = Room::query()->pluck('room_name', 'room_id')->all();
        $roomName = Room::query()->where('room_id', $room_id)->first();
        return view(self::PATH_VIEW.__FUNCTION__, compact('seats', 'roomName', 'rooms'));
    }
}
