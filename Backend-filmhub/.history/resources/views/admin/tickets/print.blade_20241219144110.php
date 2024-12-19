<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>

    <style>
         body {

            background-color: #f8f9fa;
            padding: 20px;
        }

        .ticket {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
        }

        .ticket h3 {
            margin-top: 0;
        }

        .ticket p {
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <div class="ticket">
        <h4><strong>ID:</strong> {{ $ticket->ticket_id }}</h4>
        <h4><strong>Tên người dùng:</strong> {{ $ticket->user->name }}</h4>
        <h4><strong>Tên phim:</strong> {{ $ticket->showtime->movie->title }}</h4>
        <h4><strong>Tên phòng:</strong> Phòng {{ $ticket->showtime->rooms->room_name }}</h4>
        <h4><strong>Rạp:</strong> {{ $ticket->showtime->rooms->theater->name }}</h4>
        <h4><strong>Thời gian chiếu:</strong> {{ $ticket->showtime->shifts->start_time }} to
            {{ $ticket->showtime->shifts->end_time }}</h4>
        <h4><strong>Ghế:</strong> {{ $seat->seat->seat_number }}</h4> <!-- Hiển thị số ghế của từng vé -->
        @if ($ticket->combo)
            <h4><strong>Combo:</strong> {{ $ticket->combo->name }}</h4>
        @endif

        @if ($ticket->food)
            <h4><strong>Đồ ăn:</strong> {{ $ticket->food->name }}</h4>
        @endif

        @if ($ticket->drink)
            <h4><strong>Nước uống:</strong> {{ $ticket->drink->name }}</h4>
        @endif

        <h4><strong>Tổng tiền:</strong> {{ $ticket->total_price }} VND</h4>
        <h4><strong>Trạng thái:</strong> {{ $ticket->status }}</h4>
    </div>

</body>

</html>
