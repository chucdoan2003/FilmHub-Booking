@extends('admin.layouts.master')

@section('title')
<<<<<<< HEAD
    Ticket Detail
=======

>>>>>>> c34dbe889404f10f96635ee1e20595a13ffb06b5
@endsection

@section('style-libs')
    <!-- Custom styles for this page -->
    <link href="{{ asset('theme/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<<<<<<< HEAD
=======
    <style>
        .ticket-details-container {
            margin-top: 30px;
            background: #f8f9fc;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .ticket-details-table th {
            background: #4e73df;
            color: white;
            text-align: left;
        }

        .ticket-details-table tbody tr:nth-child(even) {
            background: #f2f2f2;
        }

        .ticket-details-title {
            color: #4e73df;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
>>>>>>> c34dbe889404f10f96635ee1e20595a13ffb06b5
@endsection

@section('script-libs')
    <!-- Page level plugins -->
    <script src="{{ asset('theme/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('theme/admin/js/demo/datatables-demo.js') }}"></script>
@endsection

@section('content')
<<<<<<< HEAD
    <div class="container">
        <h1>Ticket Details</h1>
        <table class="table">
=======
    <div class="container ticket-details-container">
        <h1 class="ticket-details-title">Ticket Details</h1>
        <table class="table ticket-details-table table-bordered">
>>>>>>> c34dbe889404f10f96635ee1e20595a13ffb06b5
            <thead>
                <tr>
                    <th>Attribute</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>User Name</td>
                    <td>{{ $ticket->user->name }}</td>
                </tr>
                <tr>
                    <td>Movie Title</td>
                    <td>{{ $ticket->showtime->movie->title }}</td>
                </tr>
                <tr>
                    <td>Room Name</td>
                    <td>Phòng {{ $ticket->showtime->rooms->room_name }}</td>
                </tr>
                <tr>
                    <td>Theater Name</td>
                    <td>{{ $ticket->showtime->rooms->theater->name }}</td>
                </tr>
                <tr>
                    <td>Shift Time</td>
                    <td>{{ $ticket->showtime->shifts->start_time }} to {{ $ticket->showtime->shifts->end_time }}</td>
                </tr>
                <tr>
                    <td>Seats</td>
                    <td>
                        @foreach ($ticket->ticketsSeats as $seat)
                            {{ $seat->seat->seat_number }}@if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                </tr>
<<<<<<< HEAD
                @if ($ticket->combo)
                    <tr>
                        <td>Combo</td>
                        <td>{{ $ticket->combo->name }}</td>
                    </tr>
                @endif

                @if ($ticket->food)
                    <tr>
                        <td>Food</td>
                        <td>{{ $ticket->food->name }}</td>
                    </tr>
                @endif

                @if ($ticket->drink)
                    <tr>
                        <td>Drink</td>
                        <td>{{ $ticket->drink->name }}</td>
                    </tr>
                @endif


=======
                <tr>
                    <td>Combo</td>
                    <td>{{ $ticket->combo ? $ticket->combo->name : 'N/A' }}</td>
</tr>
>>>>>>> c34dbe889404f10f96635ee1e20595a13ffb06b5
                <tr>
                    <td>Total Price</td>
                    <td>{{ $ticket->total_price }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $ticket->status }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('admin.tickets.print', $ticket->ticket_id) }}" class="btn btn-primary">In Vé</a>
    </div>
<<<<<<< HEAD
=======

>>>>>>> c34dbe889404f10f96635ee1e20595a13ffb06b5
@endsection
