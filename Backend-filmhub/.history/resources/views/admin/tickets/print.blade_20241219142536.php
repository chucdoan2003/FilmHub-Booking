<!DOCTYPE html>
<html lang="en">

        .ticket .qr {
            text-align: center;
            margin-top: 20px;
        }

        .ticket .qr img {
            width: 100px;
            height: 100px;
        }

        .ticket .cut-line {
            position: absolute;
            top: 0;
            left: 50%;
            height: 100%;
            width: 1px;
            background: repeating-linear-gradient(
                to bottom,
                #ccc 0,
                #ccc 5px,
                transparent 5px,
                transparent 10px
            );
            transform: translateX(-50%);
        }
    </style>
</head>

<body>

    <div class="ticket">
        <h3>Vé Xem Phim</h3>

        <p><strong>ID:</strong> {{ $ticket->ticket_id }}</p>
        <p><strong>Tên khách hàng:</strong> {{ $ticket->user->name }}</p>
        <p><strong>Tên phim:</strong> {{ $ticket->showtime->movie->title }}</p>
        <p><strong>Phòng chiếu:</strong> Phòng {{ $ticket->showtime->rooms->room_name }}</p>
        <p><strong>Rạp:</strong> {{ $ticket->showtime->rooms->theater->name }}</p>
        <p><strong>Thời gian:</strong> {{ $ticket->showtime->shifts->start_time }} -
            {{ $ticket->showtime->shifts->end_time }}</p>
        <p><strong>Ghế:</strong> {{ $seat->seat->seat_number }}</p>

        @if ($ticket->combo)
            <p><strong>Combo:</strong> {{ $ticket->combo->name }}</p>
        @endif

        @if ($ticket->food)
            <p><strong>Đồ ăn:</strong> {{ $ticket->food->name }}</p>
        @endif

        @if ($ticket->drink)
            <p><strong>Thức uống:</strong> {{ $ticket->drink->name }}</p>
        @endif

        <div class="divider"></div>

        <p><strong>Tổng tiền:</strong> {{ number_format($ticket->total_price, 0, ',', '.') }} VND</p>
        <p><strong>Trạng thái:</strong> {{ $ticket->status }}</p>


    </div>

</body>

</html>

