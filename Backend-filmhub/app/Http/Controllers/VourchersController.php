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
    public function getma($mavourcher){
        $vourcher = DB::table('vourchers')->where('vourcher_code', $mavourcher)->first();
        return response()->json([
            'message'=>"lấy vourcher thành công",
            "data"=>$vourcher
        ]);
    }
    public function appma($price, $vourcher_price){
        $price_real= $price*(100 - $vourcher_price);
        return response()->json([
            "message"=>"app mã thành công",
            "data"=>$price_real
        ]);


    }
    public function userVourchers($id){
        $vouchers = DB::table('vourcher_user')
        ->join('vourchers', 'vourcher_user.vourcher_id', '=', 'vourchers.id')
        ->where('vourcher_user.user_id', 2)
        ->get();
        return response()->json([
            "message"=>"lấy danh sách vourcher thành công",
            "data"=>$vouchers
        ]);
    }

}
