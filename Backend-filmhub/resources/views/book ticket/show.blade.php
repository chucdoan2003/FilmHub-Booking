@extends('admin.layouts.master')

@section('title')
    Đặt Vé
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('vnpay_payment') }}" method="POST" id="payment-form">
            @csrf
            <input type="hidden" name="showtime_id" value="{{ $showtime->showtime_id }}">
            <input type="hidden" name="user_id" value="1">
            <!-- Thay đổi giá trị này cho phù hợp với người dùng hiện tại -->
            <input type="hidden" id="selected_seats" name="selected_seats" value="">

            <h1>Thông tin phim</h1>
            <div>
                <h2>{{ $showtime->movie->title }}</h2>

                <img src="{{ Storage::url($showtime->movie->poster_url) }}" style="width: 200px; height: auto;"
                    alt="Poster">

                <p><strong>Mô tả:</strong> {{ $showtime->movie->description }}</p>

                @php


                    $shiftStartTime = \Carbon\Carbon::parse($showtime->shift->start_time);
                    $shiftEndTime = \Carbon\Carbon::parse($showtime->shift->end_time);
                @endphp

                <p><strong>Thời gian chiếu:</strong>
                    {{ \Carbon\Carbon::parse($showtime->datetime)->format('d/m/Y ') }}
                </p>
                <p><strong>Ca chiếu:</strong> {{ $showtime->shift->shift_name }} :
                    {{ $shiftStartTime->format('H:i') }} - {{ $shiftEndTime->format('H:i') }}
                </p>


                <p><strong>Phòng:</strong> {{ $showtime->room->room_name }}</p>
                <p><strong>Thời gian:</strong> {{ $showtime->movie->duration }} phút</p>
                <p><strong>Giá vé:</strong> {{ number_format($showtime->value) }} VND</p>
            </div>

            <h2>Chọn ghế</h2>
            <div class="seat-selection">
                @foreach ($showtime->room->seats as $seat)
                    <div class="seat">
                        <input type="checkbox" id="seat-{{ $seat->seat_id }}" value="{{ $seat->seat_id }}"
                            data-price="{{ $showtime->value }}" @if (in_array($seat->seat_id, $bookedSeats)) disabled @endif>
                        <label for="seat-{{ $seat->seat_id }}"

                            @if (in_array($seat->seat_id, $bookedSeats)) style="color: grey;" @endif>
                            {{ $seat->number }} (Số: {{ $seat->seat_id }})


                        </label>
                    </div>
                @endforeach
            </div>
            <p><strong>Ghế đã chọn:</strong> <span id="selected-seats-display">Chưa có ghế nào được chọn</span></p>

            <h3>Tổng tiền: <span id="total-price-display">0</span> VND</h3>
            <input type="hidden" id="total-price" value="0" name="total" />
            <button type="submit" class="btn btn-success" id="book-ticket-btn" name="redirect">Xác nhận đặt vé</button>
        </form>
    </div>

    <script>
        // JavaScript cập nhật giá tiền và ghế đã chọn
        document.querySelectorAll('.seat input[type="checkbox"]').forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                updateTotalPrice();
            });
        });

        function updateTotalPrice() {
            let total = 0;
            const checkboxes = document.querySelectorAll('.seat input[type="checkbox"]:checked');
            const selectedSeatIds = [];

            checkboxes.forEach((checkbox) => {
                total += parseInt(checkbox.getAttribute('data-price'));
                selectedSeatIds.push(checkbox.value);
            });

            document.getElementById('total-price').value = total;
            document.getElementById('total-price-display').innerText = total.toLocaleString();
            document.getElementById('selected_seats').value = selectedSeatIds.join(','); // Cập nhật giá trị ghế đã chọn
            document.getElementById('selected-seats-display').innerText = selectedSeatIds.join(', ') ||
                'Chưa có ghế nào được chọn';
        }

        // Kiểm tra khi gửi form
        document.getElementById('payment-form').addEventListener('submit', function(e) {

            if (document.getElementById('selected_seats').value === '') {
                e.preventDefault();
                alert('Vui lòng chọn ít nhất một ghế!');
            }
        });
    </script>
@endsection
