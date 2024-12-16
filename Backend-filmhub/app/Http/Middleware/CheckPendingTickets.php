<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckPendingTickets
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $timeout = 5;


        $expiredTickets = DB::table('tickets')
            ->where('status', 'pending')
            ->where('ticket_time', '<', Carbon::now()->subMinutes($timeout))
            ->get();

        foreach ($expiredTickets as $ticket) {
            // Xóa ghế liên quan trong bảng tickets_seats
            DB::table('tickets_seats')->where('ticket_id', $ticket->ticket_id)->delete();

            // Xóa vé trong bảng tickets
            DB::table('tickets')->where('ticket_id', $ticket->ticket_id)->delete();

            // Thêm cảnh báo vào bảng user_warning
            DB::table('user_warning')->insert([
                'user_id' => $ticket->user_id, // Lấy user_id từ vé
                'created_at' => Carbon::now(), // Thời gian hiện tại
                'updated_at' => Carbon::now(),
            ]);

            // Kiểm tra nếu người dùng đã có 3 lần cảnh báo
            $warningCount = DB::table('user_warning')
                ->where('user_id', $ticket->user_id)
                ->count();

            if ($warningCount >= 3) {

                DB::table('users')
                    ->where('user_id', $ticket->user_id)
                    ->update(['status' => 'banned']);
            }
        }

        return $next($request);
    }
}

