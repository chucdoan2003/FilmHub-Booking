@extends('admin.layouts.master')
@section('content')
    <h1>Edit Showtime</h1>

    <form action="{{ route('admin.showtimes.update', $showtime->showtime_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="movie_id" class="form-label">Movie:</label>
            <select name="movie_id" id="movie_id" class="form-control" required>
                <option value="">Select a movie</option>
                @foreach ($movies as $movie)
                    <option value="{{ $movie->movie_id }}" {{ $movie->movie_id == $showtime->movie_id ? 'selected' : '' }}>
                        {{ $movie->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="room_id" class="form-label">Room:</label>
            <select name="room_id" id="room_id" class="form-control" required>
                <option value="">Select a room</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->room_id }}" {{ $room->room_id == $showtime->room_id ? 'selected' : '' }}>
                        {{ $room->room_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="shift_id" class="form-label">Shift:</label>
            <select name="shift_id" id="shift_id" class="form-control" required>
                <option value="">Select a shift</option>
                @foreach ($shifts as $shift)
                    <option value="{{ $shift->shift_id }}" {{ $shift->shift_id == $showtime->shift_id ? 'selected' : '' }}>
                        {{ $shift->shift_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time:</label>
            <input type="datetime-local" name="start_time" id="start_time" class="form-control"
                value="{{ \Carbon\Carbon::parse($showtime->start_time)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time:</label>
            <input type="datetime-local" name="end_time" id="end_time" class="form-control"
                value="{{ \Carbon\Carbon::parse($showtime->end_time)->format('Y-m-d\TH:i') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Showtime</button>
    </form>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
