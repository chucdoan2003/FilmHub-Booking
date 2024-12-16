<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rules\StartTimeBeforeEndTime;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VourcherAdmminController extends Controller
{
    public function index(){
        $now = Carbon::now();
        $vourchers=DB::table('vourchers')->latest()->paginate(5);
        return view('admin.vourchers.index', compact('vourchers', 'now'));
    }
    public function create(){
        return view('admin.vourchers.add');
    }
    public function store(Request $request){
        $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
        $start_time = new DateTime($request->start_time, $timezone);
        $end_time = new DateTime($request->end_time, $timezone);
        // dd($start_time->format('Y-m-d H:i:s'), $end_time->format('Y-m-d H:i:s'));
     
        $request->validate([
            'vourcher_code'=>'required',
            'vourcher_price'=>'required|numeric',
            'start_time'=>['required', new StartTimeBeforeEndTime($request->end_time)],
            'end_time'=>'required',
            'vourcher_type'=>'required',
        ]);
        DB::table('vourchers')->insert([
            'vourcher_code'=>$request->vourcher_code,
            'vourcher_price'=>$request->vourcher_price,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'type'=>$request->vourcher_type,  
           
        ]);
        return redirect()->route('vourchers.index');
    }
    public function edit($id){
        $vourcher=DB::table('vourchers')->where('id',$id)->first();
        return view('admin.vourchers.edit',compact('vourcher'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'vourcher_code'=>'required',
            'vourcher_price'=>'required|numeric',
        ]);
        DB::table('vourchers')->where('id',$id)->update([
            'vourcher_code'=>$request->vourcher_code,
            'vourcher_price'=>$request->vourcher_price,
        ]);
        return redirect()->route('vourchers.index');
    }
    public function destroy($id){
        DB::table('vourchers')->where('id',$id)->delete();
        return redirect()->route('vourchers.index');
    }
}
