<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use TCPDF;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with([
            'user',
            'showtime.movie',
            'showtime.rooms.theater',
            'showtime.shifts',
            'ticketsSeats',
            'combo'
        ])->get();

        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $ticket->load([
            'user',
            'showtime.movie',
            'showtime.rooms',
            'showtime.shifts',
            'ticketsSeats'
        ]);

        return view('admin.tickets.show', compact('ticket'));
    }

    public function printTicket(Ticket $ticket)
{
    // Tạo một instance TCPDF
    $pdf = new TCPDF();

    // Lặp qua các ghế và tạo một trang mới cho mỗi ghế
    foreach ($ticket->ticketsSeats as $seat) {
        // Tạo dữ liệu cho mỗi ghế
        $data = compact('ticket', 'seat');

        // Đưa thông tin vào PDF (chẳng hạn như render HTML vào PDF)
        $html = view('admin.tickets.print', $data)->render();

        // Thêm một trang mới cho mỗi ghế
        $pdf->AddPage();

        // In nội dung vào trang hiện tại
        $pdf->writeHTML($html);
    }

    // Xuất PDF và hiển thị trực tiếp trên trình duyệt
    return response($pdf->Output('ticket_' . $ticket->ticket_id . '.pdf', 'I'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
