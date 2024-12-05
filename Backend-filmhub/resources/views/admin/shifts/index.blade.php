@extends('admin.layouts.master')
@section('content')
    <h1>Danh Sách Shifts</h1>
    <a href="{{ route('admin.shifts.create') }}" class="btn btn-success">Tạo Shift Mới</a>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Shift ID</th>
                <th scope="col">Tên Shift</th>
                <th scope="col">Giờ Bắt Đầu</th>
                <th scope="col">Giờ Kết Thúc</th>
                <th scope="col">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shifts as $shift)
                <tr>
                    <td scope="row">{{ $shift->shift_id }}</td>
                    <td>{{ $shift->shift_name }}</td>
                    <td>{{ $shift->start_time }}</td>
                    <td>{{ $shift->end_time }}</td>
                    <td>
                        <a href="{{ route('admin.shifts.edit', $shift->shift_id) }}" class="btn btn-primary">Chỉnh Sửa</a>
                        <form action="{{ route('admin.shifts.destroy', $shift->shift_id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this shift?');" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
