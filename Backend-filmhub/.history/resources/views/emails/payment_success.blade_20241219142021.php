<!DOCTYPE html>
<html>

<head>
    <title>Xác nhận Thanh toán</title>
</head>

<body>
    <h1>Xin chào {{ $ticket->user->name }},</h1>
    <p>Cảm ơn bạn đã đặt vé xem phim tại hệ thống của chúng tôi.</p>
    <p>Thông tin chi tiết:</p>
    <ul>
        <li><strong>Mã vé:</strong> {{ $ticket->ticket_id }}</li>
        <li><strong>Suất chiếu:</strong> {{ $ticket->showtime_id }}</li>
        <li><strong>Số tiền:</strong> {{ number_format($ticket->total_price, 0, ',', '.') }} VND</li>
        <li><strong>Thời gian thanh toán:</strong> {{ $ticket->ticket_time }}</li>

    </ul>
    <p>Chúc bạn xem phim vui vẻ!</p>
</body>

</html>
