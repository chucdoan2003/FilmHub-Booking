<h1>Tạo Shift Mới</h1>

<form action="{{ route('admin.shifts.store') }}" method="POST">
    @csrf
    <label for="shift_name">Tên Shift:</label>
    <input type="text" name="shift_name" required>

    <label for="start_time">Giờ Bắt Đầu:</label>
    <input type="time" name="start_time" required>

    <label for="end_time">Giờ Kết Thúc:</label>
    <input type="time" name="end_time" required>

    <button type="submit">Tạo</button>
</form>
