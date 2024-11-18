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
        $timeout = 16;

        // Lấy tất cả các vé ở trạng thái 'pending' đã hết hạn
        $expiredTickets = DB::table('tickets')
            ->where('status', 'pending')
            ->where('ticket_time', '<', Carbon::now()->subMinutes($timeout))
            ->get();

        foreach ($expiredTickets as $ticket) {
            // Xóa ghế liên quan
            DB::table('tickets_seats')->where('ticket_id', $ticket->ticket_id)->delete();

            // Xóa vé
            DB::table('tickets')->where('ticket_id', $ticket->ticket_id)->delete();
        }

        return $next($request);
    }
}

