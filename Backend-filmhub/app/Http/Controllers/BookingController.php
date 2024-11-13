<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Models\Movie;
use App\Models\Ticket;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {

        $showtimes = Showtime::with(['movie', 'room', 'shift'])->get();
        $selectedSeats = [];
        return view('book ticket.index', compact('showtimes', 'selectedSeats'));
    }

    public function show($showtimeId)
    {

        $showtime = Showtime::with('movie', 'room.seats', 'shift')->where('showtime_id', $showtimeId)->firstOrFail();

        // Lấy danh sách ghế đã được đặt cho showtime này từ bảng ticket_seat
        $bookedSeats = DB::table('tickets_seats')
                        ->where('showtime_id', $showtimeId)
                        ->pluck('seat_id')->toArray();
                        // dd($bookedSeats);
        return view('book ticket.show', compact('showtime', 'bookedSeats'));
    }



}
