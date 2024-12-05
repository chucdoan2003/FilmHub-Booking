<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Lấy tất cả các bản ghi trong CSDL
            $data = Type::all();
            return response()->json([
                'status'=>true,
                'message'=> 'Get type list successfully',
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
            'type_name' => ['required']
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
            $type = Type::query()->create([
                'type_name'=> $request->type_name
            ]);
            // Trả về phản hồi thành công
            return response()->json([
                'status'=>true,
                'message'=> 'Created successfully',
                'data'=> $type
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred while creating the type",
                'description' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $type_id)
    {
        $type = Type::query()->where('type_id',$type_id)->first();
        if (!$type) {
            return response()->json([
                'status' => false,
                'message' => 'This type was not found'
            ], 404);
        }
    
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'type_name' => ['required'],
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
            $type->update([
                'type_name' => $request->type_name,
            ]);
            return response()->json([
                'status' => true,
                'message' => "Updated successfully",
                'data' => $type
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
    public function destroy(string $type_id)
    {
        $type = Type::query()->where('type_id', $type_id)->first();
        if(!$type){
            $res = [
                'status'=>false,
                'message'=>'This type was not found',
            ];
            return response()->json($res, status:404);
        }
        $type->delete();
        $res = [
            'status'=>true,
            'message'=>'Delete successfully',
        ];
        return response()->json($res, status:200);
    }
}
