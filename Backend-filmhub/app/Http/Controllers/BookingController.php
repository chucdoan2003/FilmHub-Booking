<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Models\Movie;
use App\Models\Ticket;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{

    // public function __construct()
    // {
    //     // Mỗi khi controller được gọi sẽ thực hiện kiểm tra trạng thái vé pending
    //     $this->checkPendingTickets();
    // }
    public function index()
    {

        $showtimes = Showtime::with(['movie', 'room', 'shift'])->get();
        $selectedSeats = [];
        return view('book ticket.index', compact('showtimes', 'selectedSeats'));
    }

    public function show($showtimeId)
    {

        $showtime = Showtime::with('movie', 'room.seats', 'shift')->where('showtime_id', $showtimeId)->firstOrFail();

        $foods = DB::table('foods')->get();
        $drinks = DB::table('drinks')->get();
        $combos = DB::table('combos')->get();

        // Lấy danh sách ghế đã được đặt cho showtime này từ bảng ticket_seat
        $bookedSeats = DB::table('tickets_seats')
                        ->where('showtime_id', $showtimeId)
                        ->pluck('seat_id')->toArray();
                        // dd($bookedSeats);
        return view('book ticket.show', compact('showtime', 'bookedSeats', 'foods', 'drinks', 'combos'));
    }



    // private function checkPendingTickets()
    // {
    //     // Lấy các vé có status là "pending"
    //     $pendingTickets = Ticket::where('status', 'pending')->get();

    //     foreach ($pendingTickets as $ticket) {
    //         // Kiểm tra xem vé có ticket_time không và chuyển ticket_time thành đối tượng Carbon
    //         if ($ticket->ticket_time) {
    //             $ticketTime = Carbon::parse($ticket->ticket_time); // Chuyển ticket_time thành Carbon

    //             // Kiểm tra xem vé có quá thời gian quy định không (sau 16 phút)
    //             if ($ticketTime->addMinutes(16) < now()) {
    //                 // Cập nhật trạng thái vé thành "failed"
    //                 $ticket->update(['status' => 'failed']);

    //                 // Xóa các ghế liên quan trong bảng ticket_seats
    //                 DB::table('tickets_seats')->where('ticket_id', $ticket->id)->delete();
    //             }
    //         }
    //     }
    // }
}
