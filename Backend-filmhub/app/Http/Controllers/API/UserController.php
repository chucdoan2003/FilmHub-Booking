<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users= User::query()->latest()->paginate(5);
            return response()->json([
                "message"=> "Get list user succed page ". request('page', $users->currentPage()),
                "RC"=>0,
                "data"=>$users
            ],Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error(__CLASS__ ."@".__FUNCTION__,[
                "line"=>$th->getLine(),
                "message"=>$th->getMessage()
            ]  );
            return response()->json([
                "message"=>"Get list users fail"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::query()->create($request->all());
            if(!$user){
                return response()->json([
                    "message"=>"Add User is fails",
                    "RC"=>-1
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }else{
                return response()->json([
                    "message"=>"Add User succed",
                    "RC"=>0,
                    "data"=>$user
                ], Response::HTTP_OK);

            }
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@". __FUNCTION__,[
                "line"=>$th->getLine(),
                "message"=>$th->getMessage()
            ]);
            return response()->json([
                    "message"=>"Add User is fails",
                    "RC"=>-1
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::query()
            ->where("id", $id)
            ->select("name", "email", "type")
            ->first()
            ;
            if ($user) {
               return response()->json([
                    "message"=>"Get user succed",
                    "RC"=>0,
                    "data"=>new UserResource($user)
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    "message"=>"Get user fails",
                    "RC"=>-1,
                ], Response::HTTP_NOT_FOUND);
            }
                
            
            
        } catch (\Throwable $th) {
             Log::error(__CLASS__ ."@".__FUNCTION__,[
                "line"=>$th->getLine(),
                "message"=>$th->getMessage()
            ]  );
            // if($th instanceof ModelNotFoundException){
            //         return response()->json([
            //         "message"=>"User not found",
            //     ], Response::HTTP_NOT_FOUND);
            // }
            return $th;
           
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::query()->where('id', $id)->update([
                "name"=>$request->name,
                "email"=>$request->email,
                
            ]);
            if(!$user){
                return response()->json([
                    "message"=>"Update User is fails",
                    "RC"=>-1
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }else{
                return response()->json([
                    "message"=>"Add User succed",
                    "RC"=>0,
                    "data"=>$user
                ], Response::HTTP_OK);

            }
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@". __FUNCTION__,[
                "line"=>$th->getLine(),
                "message"=>$th->getMessage()
            ]);
            return response()->json([
                    "message"=>"Add User is fails",
                    "RC"=>-1
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::query()->where('id', $id)->delete();
            if(!$user){
                return response()->json([
                    "message"=>"User not found",
                    "RC"=>-1
                ], Response::HTTP_NOT_FOUND);
            }else{
                return response()->json([
                    "message"=>"Delete User Succed",
                    "RC"=>0,

                ]);
            }
            
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@". __FUNCTION__, [
                "line"=> $th->getLine(),
                "message"=>$th->getMessage()
            ]);
            return response()->json([
                "message"=>"User not found",
                "RC"=>-1
            ], Response::HTTP_OK);
            
        }
    }
}
