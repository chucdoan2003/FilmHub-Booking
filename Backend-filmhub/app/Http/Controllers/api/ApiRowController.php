<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Row;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiRowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Lấy tất cả các bản ghi trong CSDL
            $data = Row::all();
            return response()->json([
                'status'=>true,
                'message'=> 'Get row list successfully',
                'data'=>$data
            ], 200);
        } catch (\Exception $e) {
            // Bắt lỗi và trả về phản hồi lỗi
            return response()->json([
                'status' => false,
                'message' => "Database connection error",
                'description' => $e->getMessage()
            ], 500);
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
        // xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'row_name' => ['required']
        ]);

        // Xử lý nếu xác thực thất bại
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=> 'Data check error',
                'description'=> $validator->errors()
            ]);
        }
        try {
            // Tạo bản ghi mới trong CSDL
            $row = Row::query()->create([
                'row_name'=> $request->row_name
            ]);
            // Trả về phản hồi thành công
            return response()->json([
                'status'=>true,
                'message'=> 'Created successfully',
                'data'=> $row
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred while creating the row",
                'description' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $row_id)
    {
    
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
    public function update(Request $request, string $row_id)
    {
        $row = Row::query()->where('row_id',$row_id)->first();
        if (!$row) {
            return response()->json([
                'status' => false,
                'message' => 'This row was not found'
            ], 404);
        }
    
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'row_name' => ['required'],
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
            $row->update([
                'row_name' => $request->row_name,
            ]);
            return response()->json([
                'status' => true,
                'message' => "Updated successfully",
                'data' => $row
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred while updating the row",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $row_id)
    {
        $row = Row::query()->where('row_id', $row_id)->first();
        if(!$row){
            $res = [
                'status'=>false,
                'message'=>'This row was not found',
            ];
            return response()->json($res, status:404);
        }
        $row->delete();
        $res = [
            'status'=>true,
            'message'=>'Delete successfully',
        ];
        return response()->json($res, status:200);
    }
}
