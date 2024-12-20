<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <style>
         body {
            font-family: 'Roboto', sans-serif;
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
        <p><strong>ID:</strong> {{ $ticket->ticket_id }}</p>
        <p><strong>User Name:</strong> {{ $ticket->user->name }}</p>
        <p><strong>Movie Title:</strong> {{ $ticket->showtime->movie->title }}</p>
        <p><strong>Room Name:</strong> Phòng {{ $ticket->showtime->rooms->room_name }}</p>
        <p><strong>Theater Name:</strong> {{ $ticket->showtime->rooms->theater->name }}</p>
        <p><strong>Shift Time:</strong> {{ $ticket->showtime->shifts->start_time }} to
            {{ $ticket->showtime->shifts->end_time }}</p>
        <p><strong>Seats:</strong> {{ $seat->seat->seat_number }}</p> <!-- Hiển thị số ghế của từng vé -->
        @if ($ticket->combo)
            <p><strong>Combo:</strong> {{ $ticket->combo->name }}</p>
        @endif

        @if ($ticket->food)
            <p><strong>Food:</strong> {{ $ticket->food->name }}</p>
        @endif

        @if ($ticket->drink)
            <p><strong>Drink:</strong> {{ $ticket->drink->name }}</p>
        @endif

        <p><strong>Total Price:</strong> {{ $ticket->total_price }}</p>
        <p><strong>Status:</strong> {{ $ticket->status }}</p>
    </div>

</body>

</html>
