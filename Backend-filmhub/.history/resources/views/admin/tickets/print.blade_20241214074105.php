<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
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
        <h3><strong>ID:</strong> {{ $ticket->ticket_id }}</h3>
        <h3><strong>User Name:</strong> {{ $ticket->user->name }}</h3>
        <h3><strong>Movie Title:</strong> {{ $ticket->showtime->movie->title }}</h3>
        <h3><strong>Room Name:</strong> Phòng {{ $ticket->showtime->rooms->room_name }}</h3>
        <h3><strong>Theater Name:</strong> {{ $ticket->showtime->rooms->theater->name }}</h3>
        <h3><strong>Shift Time:</strong> {{ $ticket->showtime->shifts->start_time }} to
            {{ $ticket->showtime->shifts->end_time }}</h3>
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