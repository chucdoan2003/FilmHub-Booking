<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VourcherAdmminController extends Controller
{
    public function index(){
        $vourchers=DB::table('vourchers')->latest()->paginate(5);
        return view('admin.vourchers.index', compact('vourchers'));
    }
    public function create(){
        return view('admin.vourchers.add');
    }
    public function store(Request $request){
        $request->validate([
            'vourcher_code'=>'required',
            'vourcher_name'=>'required',
            'required_points' =>'required',
            'discount_percentage'=>'required|numeric',
            'max_discount_amount'=>'required|numeric'
        ]);
        DB::table('vourchers')->insert([
            'vourcher_code'=>$request->vourcher_code,
            'vourcher_name'=>$request->vourcher_name,
            'required_points'=>$request->required_points,
            'discount_percentage'=>$request->discount_percentage,
            'max_discount_amount'=>$request->max_discount_amount

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
            'vourcher_name'=>'required',
            'required_points' =>'required',
            'discount_percentage'=>'required|numeric',
            'max_discount_amount'=>'required|numeric'
        ]);
        DB::table('vourchers')->where('id',$id)->update([
            'vourcher_code'=>$request->vourcher_code,
            'vourcher_name'=>$request->vourcher_name,
            'required_points'=>$request->required_points,
            'discount_percentage'=>$request->discount_percentage,
            'max_discount_amount'=>$request->max_discount_amount
        ]);
        return redirect()->route('vourchers.index');
    }
    public function destroy($id){
        DB::table('vourchers')->where('id',$id)->delete();
        return redirect()->route('vourchers.index');
    }
}
