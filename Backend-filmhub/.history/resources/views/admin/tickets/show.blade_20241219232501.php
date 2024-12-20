@extends('admin.layouts.master')

@section('title')
@endsection

@section('style-libs')
    <!-- Custom styles for this page -->
    <link href="{{ asset('theme/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
@endsection

@section('script-libs')
    <!-- Page level plugins -->
    <script src="{{ asset('theme/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('theme/admin/js/demo/datatables-demo.js') }}"></script>
@endsection

@section('content')
    <div class="container ticket-details-container">
        <h1 class="ticket-details-title">Ticket Details</h1>
        <table class="table ticket-details-table table-bordered">
            <thead>
                <tr>
                    <th>Attribute</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tên Người dùng</td>
                    <td>{{ $ticket->user->name }}</td>
                </tr>
                <tr>
                    <td>Phim</td>
                    <td>{{ $ticket->showtime->movie->title }}</td>
                </tr>
                <tr>
                    <td>Phòng</td>
                    <td>Phòng {{ $ticket->showtime->rooms->room_name }}</td>
                </tr>
                <tr>
                    <td>Rạp</td>
                    <td>{{ $ticket->showtime->rooms->theater->name }}</td>
                </tr>
                <tr>
                    <td>Thời gian</td>
                    <td>{{ $ticket->showtime->shifts->start_time }} to {{ $ticket->showtime->shifts->end_time }}</td>
                </tr>
                <tr>
                    <td>Ghế</td>
                    <td>
                        @foreach ($ticket->ticketsSeats as $seat)
                            {{ $seat->seat->seat_number }}@if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Combo</td>
                    <td>{{ $ticket->combo ? $ticket->combo->name : 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Đồ ăn </td>
                    <td>{{ $ticket->food ? $ticket->combo->name : 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Đồ uống </td>
                    <td>{{ $ticket->drink ? $ticket->combo->name : 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Tổng giá</td>
                    <td>{{ $ticket->total_price }}</td>
                </tr>
                <tr>
                    <td>Trạng thái</td>
                    <td>{{ $ticket->status }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('admin.tickets.print', $ticket->ticket_id) }}" class="btn btn-primary">In Vé</a>
    </div>
@endsection
