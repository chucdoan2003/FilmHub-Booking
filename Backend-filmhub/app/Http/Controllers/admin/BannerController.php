<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(){
        $banners=DB::table('banners')->latest()->get();
        return view('admin.banner.index', compact('banners'));
    }
    public function create(){
        $errors= [];
        return view('admin.banner.create', compact('errors'));
    }
    public function store(Request $request){
        $errors = [];
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            // if ($user->image && Storage::exists($user->image)) {
            //     Storage::delete($user->image);
            // }
            // Lưu ảnh mới
            $path = $request->file('image')->store('storage/banners', 'public'); //
            DB::table('banners')->insert([
                'name'=>$request->name,
                'image'=>$path
            ]);
            return redirect()->route('banner.index');
        }else {
            $errors['image']='ảnh không được phép để trống';
            return view('admin.banner.create', compact('errors'));
        }

    }
    public function edit($id){
        $errors= [];
        $banner=DB::table('banners')->where('banner_id', $id)->first();
        return view('admin.banner.edit', compact('banner', 'errors'));
    }
    public function update(Request $request, $id){
        $errors = [];
        $banner = DB::table('banners')->where('banner_id', $id)->first();
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($banner->image && Storage::exists($banner->image)) {
                Storage::delete($banner->image);
            }
            // Lưu ảnh mới
            $path = $request->file('image')->store('storage/banners', 'public'); //
            DB::table('banners')->where('banner_id', $id)->update([
                'name'=>$request->name,
                'image'=>$path
            ]);
            return redirect()->route('banner.index');
        }else {
            $errors['image']='ảnh không được phép để trống';
            return view('admin.banner.edit', compact('errors', 'banner'));
        }
    }
    public function destroy($id){
        $banner=DB::table('banners')->where('banner_id', $id)->first();
        if ($banner->image && Storage::exists($banner->image)) {
            Storage::delete($banner->image);
        }
        DB::table('banners')->where('banner_id', $id)->delete();
        return redirect()->route('banner.index');
    }
}
