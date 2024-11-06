@extends('admin.layouts.master')
@section('content')
    <form action="{{ route('admin.shifts.update', $shift->shift_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mt-3">
            <label for="shift_name">Tên Shift:</label>
            <input type="text" name="shift_name" value="{{ old('shift_name', $shift->shift_name) }}" class="form-control"
                required>
        </div>

        <div class="mt-3">
            <label for="start_time">Giờ Bắt Đầu:</label>
            <input type="time" name="start_time" value="{{ old('start_time', $shift->start_time) }}" class="form-control"
                required>
        </div>

        <div class="mt-3">
            <label for="end_time">Giờ Kết Thúc:</label>
            <input type="time" name="end_time" value="{{ old('end_time', $shift->end_time) }}" class="form-control"
                required>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Cập Nhật</button>
        </div>
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
