@extends('admin.layouts.master')
@section('content')
    <h1>Tạo Shift Mới</h1>

    <form action="{{ route('admin.shifts.store') }}" method="POST">
        @csrf
        <div class="mt-3">
            <label for="shift_name">Tên Shift:</label>
            <input type="text" name="shift_name" class="form-control" required>
        </div>

        <div class="mt-3">
            <label for="start_time">Giờ Bắt Đầu:</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>

        <div class="mt-3">
            <label for="end_time">Giờ Kết Thúc:</label>
            <input type="time" name="end_time" class="form-control" required>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Tạo</button>
        </div>
    </form>
@endsection
