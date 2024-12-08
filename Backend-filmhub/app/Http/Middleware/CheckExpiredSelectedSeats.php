<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckExpiredSelectedSeats
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $timeout = 3; // Thời gian timeout là 5 phút

        // Lấy các ghế đã hết thời gian chờ
        $expiredSeats = DB::table('selected_seats')
            ->where('created_at', '<', Carbon::now()->subMinutes($timeout))
            ->get();

        foreach ($expiredSeats as $seat) {
            // Xóa ghế đã chọn
            DB::table('selected_seats')->where('selected_seat_id', $seat->selected_seat_id)->delete();
        }

        return $next($request);
    }
}
