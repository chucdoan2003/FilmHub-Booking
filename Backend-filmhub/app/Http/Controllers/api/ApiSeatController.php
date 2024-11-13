<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiSeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Lấy tất cả các bản ghi trong CSDL
            $data = Seat::all();
            return response()->json([
                'status' =>true,
                'message' =>"Get seat list successfully",
                'data' =>$data
            ], 200);
        } catch (Exception $e) {
            // Bắt lỗi và trả về phản hồi lỗi
            $arr = [
                'status' =>false,
                'message' =>"Database connection error",
                'data' =>$e->getMessage()
            ];
            return response()->json($arr, $e->getCode());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Xác thực dữ liệu đầu vào
    $validator = Validator::make($request->all(), [
        'room_id' => ['required', 'exists:rooms,room_id'],
        'row_id' => ['required', 'exists:rows,row_id'],
        'type_id' => ['required', 'exists:types,type_id'],
        'seat_number' => ['required'],
        'status' => ['required'],
    ]);

    // Xử lý nếu xác thực thất bại
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => "Data check error",
            'description' => $validator->errors()
        ], 422);
    }

    try {
        // Tạo bản ghi mới trong cơ sở dữ liệu
        $seat = Seat::query()->create([
            'room_id' => $request->room_id,
            'row_id' => $request->row_id,
            'type_id' => $request->type_id,
            'seat_number' => $request->seat_number,
            'status' => $request->status,
        ]);

        // Trả về phản hồi thành công
        return response()->json([
            'status' => true,
            'message' => "Created successfully",
            'data' => $seat
        ], 201);
    } catch (\Exception $e) {
        // Bắt lỗi và trả về phản hồi lỗi
        return response()->json([
            'status' => false,
            'message' => "An error occurred while creating the seat",
            'description' => $e->getMessage()
        ], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $seat_id)
    {
        $seat = Seat::query()->where('seat_id', $seat_id)->first();
        if(!$seat){
            $res = [
                'status'=>false,
                'message'=>'This seat was not found',
            ];
            return response()->json($res, status:404);
        }
        $res = [
            'status'=>true,
            'message'=>'Seat details',
            'data'=> $seat
        ];
        return response()->json($res, status:200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $seat_id)
    {
        $seat = Seat::query()->where('seat_id', $seat_id)->first();
        if (!$seat) {
            return response()->json([
                'status' => false,
                'message' => 'This seat was not found'
            ], 404);
        }
    
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
           'room_id' => ['required', 'exists:rooms,room_id'],
            'row_id' => ['required', 'exists:rows,row_id'],
            'type_id' => ['required', 'exists:types,type_id'],
            'seat_number' => ['required'],
            'status' => ['required'],
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Data check error",
                'description' => $validator->errors()
            ], 200);
        }
    
        try {
            // Cập nhật seat
            $seat->update([
                'room_id' => $request->room_id,
                'row_id' => $request->row_id,
                'type_id' => $request->type_id,
                'seat_number' => $request->seat_number,
                'status' => $request->status,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => "Updated successfully",
                'data' => $seat
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred while updating the seat",
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $seat_id)
    {
        $seat = Seat::query()->where('seat_id', $seat_id)->first();
        if(!$seat){
            $res = [
                'status'=>false,
                'message'=>'This seat was not found',
            ];
            return response()->json($res, status:404);
        }
        $seat->delete();
        $res = [
            'status'=>true,
            'message'=>'Delete successfully',
        ];
        return response()->json($res, status:200);
    }
}
