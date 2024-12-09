@extends('admin.layouts.master')

@section('title')
    Ticket Detail
@endsection

@section('style-libs')
    <!-- Custom styles for this page -->
    <link href="{{ asset('theme/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('script-libs')
    <!-- Page level plugins -->
    <script src="{{ asset('theme/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('theme/admin/js/demo/datatables-demo.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <h1>Ticket Details</h1>
        <table class="table">
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
@endsection
