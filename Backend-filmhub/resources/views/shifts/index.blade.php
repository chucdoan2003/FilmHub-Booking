<h1>Danh Sách Shifts</h1>
<a href="{{ route('admin.shifts.create') }}">Tạo Shift Mới</a>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Shift ID</th>
            <th>Tên Shift</th>
            <th>Giờ Bắt Đầu</th>
            <th>Giờ Kết Thúc</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($shifts as $shift)
            <tr>
                <td>{{ $shift->shift_id }}</td>
                <td>{{ $shift->shift_name }}</td>
                <td>{{ $shift->start_time }}</td>
                <td>{{ $shift->end_time }}</td>
                <td>
                    <a href="{{ route('admin.shifts.edit', $shift->shift_id) }}">Chỉnh Sửa</a>
                    <form action="{{ route('admin.shifts.destroy', $shift->shift_id) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
