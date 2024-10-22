@extends('admin.layouts.master')
@section('content')
    <h1>Create Showtime</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.showtimes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="movie_id" class="form-label">Movie:</label>
            <select name="movie_id" id="movie_id" class="form-control" required>
                <option value="">Select a movie</option>
                @foreach ($movies as $movie)
                    <option value="{{ $movie->movie_id }}">{{ $movie->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="room_id" class="form-label">Room:</label>
            <select name="room_id" id="room_id" class="form-control" required>
                <option value="">Select a room</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->room_id }}">{{ $room->room_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="shift_id" class="form-label">Shift:</label>
            <select name="shift_id" id="shift_id" class="form-control" required>
                <option value="">Select a shift</option>
                @foreach ($shifts as $shift)
                    <option value="{{ $shift->shift_id }}">{{ $shift->shift_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time:</label>
            <input type="datetime-local" name="start_time" id="start_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time:</label>
            <input type="datetime-local" name="end_time" id="end_time" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Showtime</button>
    </form>
@endsection
