<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\VourcherEvent;
use App\Models\VourcherRedeem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VourchersController extends Controller
{
    public function index()
    {
        // // Lấy danh sách voucher có thể đổi
        // $vouchers = VourcherRedeem::with('user')->get(); // Hoặc lọc theo điều kiện nào đó
        $user_id = Auth::id(); // Lấy ID người dùng hiện tại

        // Lấy danh sách voucher chỉ của người dùng này
        $vouchers = VourcherRedeem::where('user_id', $user_id)->with('user')->get(); // Tải thông tin người dùng liên quan
        $currentDateTime = Carbon::now();
        $usedVouchers = DB::table('vourcher_user')
            ->where('user_id', $user_id)
            ->pluck('vourcher_id') // Lấy danh sách mã giảm giá đã sử dụng
            ->toArray();


        $vourcherEvents = VourcherEvent::where('is_active', true)
            ->where('end_time', '>', $currentDateTime)
            ->get();

        return view('frontend.redeemvourcher.index', compact('vouchers', 'usedVouchers', 'vourcherEvents'));
    }
    public function showForm() {
         if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để tiếp tục.');
    }
        $vouchers = Voucher::all(); // Lấy danh sách mã giảm giá
        return view('frontend.redeemvourcher.redeem', compact('vouchers'));
    }
    public function redeem(Request $request)
{
    $request->validate([
        'voucher_code' => 'required|string',
    ]);

    // Tìm voucher
    $voucher = Voucher::where('vourcher_code', $request->voucher_code)->first();

    if (!$voucher) {
        return redirect()->route('redeem.form')->withErrors(['voucher_code' => 'Voucher không tồn tại']);
    }

    // Lấy người dùng hiện tại
    $userId = auth()->id(); 
    $user = User::find($userId);

    // Kiểm tra điểm của người dùng
    if ($user->member_point < $voucher->required_points) {
        return redirect()->route('redeem.form')->withErrors(['voucher_code' => 'Bạn không đủ điểm để đổi voucher này']);
    }

    // Cập nhật điểm của người dùng
    $user->member_point -= $voucher->required_points;
    $user->save();

    // Lưu thông tin vào bảng vourchers_redeem
    VourcherRedeem::create([
        'user_id' => $userId,
        'voucher_id' => $voucher->id,
        'vourcher_code'=> $voucher->vourcher_code,
        'vourcher_name'=> $voucher->vourcher_name,
        'discount_percentage'=> $voucher->discount_percentage,
        'max_discount_amount'=> $voucher->max_discount_amount,
    ]);

    return redirect()->route('redeem.form')->with('success', 'Đổi voucher thành công');
}
}