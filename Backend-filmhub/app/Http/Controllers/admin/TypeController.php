<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = "admin.types.";
    public function index()
    {
        $data = Type::query()->get();
        return view(self::PATH_VIEW.__FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW.__FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $request->validate([
            'type_name'=>['required']
        ]);
        $data = $request->all();
        Type::query()->create($data);
        return redirect()->route('admin.types.index')->with('success', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        $showtime = DB::table('types')
        ->join('seats', 'types.type_id', '=', 'seats.type_id') // Join để lấy thông tin ghế
        ->join('rooms', 'seats.room_id', '=', 'rooms.room_id') // Join để lấy thông tin phòng
        ->join('showtimes', 'rooms.room_id', '=', 'showtimes.room_id') // Join để lấy thông tin ca chiếu
        ->where('types.type_id', $type->type_id) // Lọc theo loại ghế hiện tại
        ->select('showtimes.showtime_id','showtimes.datetime', 'types.type_name','rooms.room_name')
        ->first();
        // dd($showtime);
        if(!$showtime){
            return view(self::PATH_VIEW.__FUNCTION__, compact('type'));
        } else{
            return redirect()->route('admin.types.index')->with('error', 'Không thể sửa loại ghế trong ghế đã có ca chiếu');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $request->validate([
            'type_name'=>['required']
        ]);
        $data = $request->all();
        $type->update($data);
        return redirect()->route('admin.types.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $showtime = DB::table('types')
        ->join('seats', 'types.type_id', '=', 'seats.type_id') // Join để lấy thông tin ghế
        ->where('seats.type_id', $type->type_id) // Lọc theo loại ghế hiện tại
        ->first();
        // dd($showtime);
        if(!$showtime){
            $type->delete();
            return back()->with('success', 'Xóa thành công');
        } else{
            return redirect()->route('admin.types.index')->with('error', 'Không thể xóa loại ghế đã có trong ghế');
        }

    }
}
