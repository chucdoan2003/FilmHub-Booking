<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Models\Movie;
use App\Models\Ticket;

class BookingController extends Controller
{
    public function index()
    {
        $data = Movie::all();
        $showtimes = Showtime::with('movie', 'room')->get(); // Eager load movie và room

        $selectedSeats = [];
        return view('book ticket.index', compact('showtimes','data' , 'selectedSeats'));
    }

    public function show($showtimeId)
{

    $showtime = Showtime::with('movie', 'room.seats')->where('showtime_id', $showtimeId)->firstOrFail();

    return view('book ticket.show', compact('showtime'));
}

public function purchaseTicket(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'showtime_id' => 'required|exists:showtimes,id',
            'total_price' => 'required|numeric',
            'ticket_time' => 'required|date',
            'selected_seats' => 'required|string'
        ]);

        // Thêm vé vào cơ sở dữ liệu
        $ticket = Ticket::create([
            'user_id' => $request->user_id,
            'showtime_id' => $request->showtime_id,
            'total_price' => $request->total_price,
            'ticket_time' => $request->ticket_time,
        ]);

        // Thêm thông tin ghế đã chọn vào bảng ticket_seats
        $selectedSeats = explode(',', $request->selected_seats);
        foreach ($selectedSeats as $seatId) {
            \DB::table('ticket_seats')->insert([
                'ticket_id' => $ticket->id,
                'seat_id' => $seatId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Chuyển hướng đến trang thanh toán VNPAY
        return redirect()->route('vnpay.payment', ['ticket_id' => $ticket->id]);
    }
}
