<?php

namespace App\Http\Controllers;

use App\Models\vourcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VourchersController extends Controller
{
    public function index(){
        // Fetch all vouchers from your database
        $vouchers = vourcher::all();

        // Return the vouchers as a JSON response
        return response()->json([
            "message" => "Lấy danh sách vourcher thành công",
            "data" => $vouchers
        ]);
    }
    public function appma($mavourcher){
        $vourcher = DB::table('vourchers')->where('vourcher_code', $mavourcher)->first();
        return response()->json([
            'message'=>"lấy vourcher thành công",
            "data"=>$vourcher
        ]);
    }

}
