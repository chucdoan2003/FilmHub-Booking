<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Tickets;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function getUserTicketHistory(Request $request)
    {
        // Lấy thông tin user từ auth
        $user = $request->user();

        // Lấy danh sách vé của user
        $tickets = Tickets::where('user_id', $user->id)->get();

        // Trả về JSON
        return response()->json([
            'user' => $user->name,
            'tickets' => $tickets,
        ]);
    }
}
