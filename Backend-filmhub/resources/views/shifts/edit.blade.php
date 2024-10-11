<form action="{{ route('admin.shifts.update', $shift->shift_id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="shift_name">Tên Shift:</label>
    <input type="text" name="shift_name" value="{{ old('shift_name', $shift->shift_name) }}" required>

    <label for="start_time">Giờ Bắt Đầu:</label>
    <input type="time" name="start_time" value="{{ old('start_time', $shift->start_time) }}" required>

    <label for="end_time">Giờ Kết Thúc:</label>
    <input type="time" name="end_time" value="{{ old('end_time', $shift->end_time) }}" required>

    <button type="submit">Cập Nhật</button>
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
