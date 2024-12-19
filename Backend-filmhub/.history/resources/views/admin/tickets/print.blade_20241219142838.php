<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chiếc vé của bạn</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .ticket {
            border: 2px dashed #007bff;
            border-radius: 10px;
            padding: 20px;
            background-color: #ffffff;
            max-width: 600px;
            margin: 20px auto;
        }

        .ticket-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .ticket-header h1 {
            font-size: 24px;
            color: #007bff;
            margin: 0;
        }

        .ticket-details p {
            margin: 5px 0;
        }

        .ticket-details strong {
            color: #000;
        }

        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="ticket shadow">
        <div class="ticket-header">
            <h1>Vé Xem Phim</h1>
        </div>

        <div class="ticket-details">
            <p><strong>ID:</strong> {{ $ticket->ticket_id }}</p>
            <p><strong>Tên khách hàng:</strong> {{ $ticket->user->name }}</p>
            <p><strong>Tên phim:</strong> {{ $ticket->showtime->movie->title }}</p>
            <p><strong>Phòng chiếu:</strong> Phòng {{ $ticket->showtime->rooms->room_name }}</p>
            <p><strong>Rạp:</strong> {{ $ticket->showtime->rooms->theater->name }}</p>
            <p><strong>Thời gian:</strong> {{ $ticket->showtime->shifts->start_time }} - {{ $ticket->showtime->shifts->end_time }}</p>
            <p><strong>Ghế:</strong> {{ $seat->seat->seat_number }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($ticket->total_price, 0, ',', '.') }} VND</p>
            <p><strong>Trạng thái:</strong> {{ $ticket->status }}</p>
        </div>

        <div class="qr-code">
            {!! QrCode::size(150)->generate(route('tickets.show', ['ticket' => $ticket->ticket_id])) !!}
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


