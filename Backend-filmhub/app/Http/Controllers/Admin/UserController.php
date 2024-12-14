<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users= User::query()->latest()->paginate(5);
            return view("admin.users.list", compact('users'));
        } catch (\Throwable $th) {
            Log::error(__CLASS__ ."@".__FUNCTION__,[
                "line"=>$th->getLine(),
                "message"=>$th->getMessage()
            ]  );
            return view("errors.404");
            
        }

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator= $request->validate(
            [
            "name"=>"required",
            "email"=>"required|email",
            "password"=>"required",
            "password_confirmation"=>"required|same:password"
            ]
        );
        $user = User::query()->create($request->all());
        return redirect()->route('users.index');

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
        $user = User::query()
            ->where("id", $id)
            ->select("id","name", "email","password", "type")
            ->first()
            ;
        return view('admin.users.edit',compact('user') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validate= $request->validate([
                "name"=>"required",
                "email"=>"required|email",
                ]
            );
            $user = User::query()->where('id', $id)->update([
                "name"=>$request->name,
                "email"=>$request->email,
                
            ]);
           return redirect()->route('users.index');
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@". __FUNCTION__,[
                "line"=>$th->getLine(),
                "message"=>$th->getMessage()
            ]);
            return view("errors.404");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {
            $user = User::query()->where('id', $id)->delete();
            return redirect()->route('users.index');
            
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@". __FUNCTION__, [
                "line"=> $th->getLine(),
                "message"=>$th->getMessage()
            ]);
            return view('errors.404');
            
        }
    }
}
