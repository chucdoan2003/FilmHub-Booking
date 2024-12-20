<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap&subset=vietnamese" rel="stylesheet">
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
        <h4><strong>ID:</strong> {{ $ticket->ticket_id }}</h4>
        <h4><strong>User Name:</strong> {{ $ticket->user->name }}</h4>
        <h4><strong>Movie Title:</strong> {{ $ticket->showtime->movie->title }}</h4>
        <h4><strong>Room Name:</strong> Phòng {{ $ticket->showtime->rooms->room_name }}</h4>
        <h4><strong>Theater Name:</strong> {{ $ticket->showtime->rooms->theater->name }}</h4>
        <h4><strong>Shift Time:</strong> {{ $ticket->showtime->shifts->start_time }} to
            {{ $ticket->showtime->shifts->end_time }}</h4>
        <h4><strong>Seats:</strong> {{ $seat->seat->seat_number }}</h4> <!-- Hiển thị số ghế của từng vé -->
        @if ($ticket->combo)
            <h4><strong>Combo:</strong> {{ $ticket->combo->name }}</h4>
        @endif

        @if ($ticket->food)
            <h4><strong>Food:</strong> {{ $ticket->food->name }}</h4>
        @endif

        @if ($ticket->drink)
            <h4><strong>Drink:</strong> {{ $ticket->drink->name }}</h4>
        @endif

        <h4><strong>Total Price:</strong> {{ $ticket->total_h4rice }}</h4>
        <h4><strong>Status:</strong> {{ $ticket->status }}</h4>
    </div>

</body>

</html>
