@extends('admin.layouts.master')

@section('title')
    Chỉnh sửa rạp chiếu
@endsection

@section('content')
<form action="{{ route('admin.theaters.update', $theater->theater_id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="theater-name" class="form-label">Tên rạp</label>
        <input type="text" class="form-control" id="theater-name" name="name" value="{{ old('name', $theater->name) }}" required>
    </div>
    <div class="mb-3">
        <label for="theater-location" class="form-label">Địa điểm</label>
        <input type="text" class="form-control" id="theater-location" name="location" value="{{ old('location', $theater->location) }}" required>
    </div>
    {{-- <div class="mb-3">
        <label for="number_of_rooms" class="form-label">Số phòng chiếu</label>
        <input type="number" class="form-control" id="number_of_rooms" name="number_of_rooms" value="{{ old('number_of_rooms', $roomsCount) }}" required min="1">

    </div> --}}

    <div class="mt-5">
        <h3>Thông tin phòng chiếu</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên phòng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td>{{ $room->room_id }}</td>
                        <td>{{ $room->room_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <div class="mb-3">
        <label for="number_of_shifts" class="form-label">Số ca chiếu</label>
        <input type="number" class="form-control" id="number_of_shifts" name="number_of_shifts" value="{{ old('number_of_shifts', $theater->shifts->count()) }}" required min="1" onchange="updateShiftTimes()">
    </div>

    <div id="shift-times-container">
        @foreach($theater->shifts as $index => $shift)
            <div class="mb-3 d-flex">
                <div class="me-2">
                    <label for="shift_start_time_{{ $index + 1 }}" class="form-label">Bắt đầu ca chiếu {{ $index + 1 }}</label>
                    <input type="time" class="form-control" id="shift_start_time_{{ $index + 1 }}" name="shift_start_time[]" value="{{ $shift->start_time }}" required>
                </div>
                <div style="margin-left: 10px;">
                    <label for="shift_end_time_{{ $index + 1 }}" class="form-label">Kết thúc ca chiếu {{ $index + 1 }}</label>
                    <input type="time" class="form-control" id="shift_end_time_{{ $index + 1 }}" name="shift_end_time[]" value="{{ $shift->end_time }}" required>
                </div>
            </div>
        @endforeach
    </div> --}}

    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@error('shift_start_time')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror --}}

{{-- <script>
    function updateShiftTimes() {
        const numberOfShifts = document.getElementById('number_of_shifts').value;
        const container = document.getElementById('shift-times-container');
        container.innerHTML = '';

        for (let i = 1; i <= numberOfShifts; i++) {
            container.innerHTML += `
                <div class="mb-3 d-flex">
                    <div class="me-2">
                        <label for="shift_start_time_${i}" class="form-label">Bắt đầu ca chiếu ${i}</label>
                        <input type="time" class="form-control" id="shift_start_time_${i}" name="shift_start_time[]" required>
                    </div>
                    <div style="margin-left: 10px;">
                        <label for="shift_end_time_${i}" class="form-label">Kết thúc ca chiếu ${i}</label>
                        <input type="time" class="form-control" id="shift_end_time_${i}" name="shift_end_time[]" required>
                    </div>
                </div>
            `;
        }
    }
</script> --}}
@endsection
