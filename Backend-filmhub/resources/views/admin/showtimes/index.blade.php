@extends('admin.layouts.master')
@section('content')
    <h1>Showtimes</h1>
    <a href="{{ route('admin.showtimes.create') }}" class="btn btn-success">Create Showtime</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Movie</th>
                <th scope="col">Room</th>
                <th scope="col">Shift</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($showtimes as $showtime)
                <tr>
                    <td>{{ $showtime->showtime_id }}</td>
                    <td>{{ $showtime->movie->title }}</td> <!-- Hiển thị tên movie -->
                    <td>{{ $showtime->room->room_name }}</td> <!-- Hiển thị tên room -->
                    <td>{{ $showtime->shift->shift_name }}</td> <!-- Hiển thị tên shift -->
                    <td>{{ $showtime->start_time }}</td>
                    <td>{{ $showtime->end_time }}</td>
                    <td>
                        <a href="{{ route('admin.showtimes.edit', $showtime->showtime_id) }}" class="btn btn-primary">Chỉnh
                            Sửa</a>
                        <form action="{{ route('admin.showtimes.destroy', $showtime->showtime_id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this showtime?');"
                                class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
