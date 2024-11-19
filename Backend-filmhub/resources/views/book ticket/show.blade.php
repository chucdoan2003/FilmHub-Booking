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
            <input type="hidden" id="selected_foods" name="selected_foods" value="">
            <input type="hidden" id="selected_drinks" name="selected_drinks" value="">
            <input type="hidden" id="selected_combos" name="selected_combos" value="">

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

                <p><strong>Thời gian chiếu:</strong> {{ \Carbon\Carbon::parse($showtime->datetime)->format('d/m/Y ') }}</p>
                <p><strong>Ca chiếu:</strong> {{ $showtime->shift->shift_name }} : {{ $shiftStartTime->format('H:i') }} -
                    {{ $shiftEndTime->format('H:i') }}</p>
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
                            {{ $seat->number }} (Số: {{ $seat->seat_number }})
                        </label>
                    </div>
                @endforeach
            </div>
            <p><strong>Ghế đã chọn:</strong> <span id="selected-seats-display">Chưa có ghế nào được chọn</span></p>

            <select name="food_id" id="food-select">
                <option value="">Chọn món ăn</option>
                @foreach ($foods as $food)
                    <option value="{{ $food->id }}" data-price="{{ $food->price }}">{{ $food->name }}</option>
                @endforeach
            </select>

            <select name="drink_id" id="drink-select">
                <option value="">Chọn đồ uống</option>
                @foreach ($drinks as $drink)
                    <option value="{{ $drink->id }}" data-price="{{ $drink->price }}">{{ $drink->name }}</option>
                @endforeach
            </select>

            <select name="combo_id" id="combo-select">
                <option value="">Chọn combo</option>
                @foreach ($combos as $combo)
                    <option value="{{ $combo->id }}" data-price="{{ $combo->price }}">{{ $combo->name }}</option>
                @endforeach
            </select>

            <h3>Tổng tiền: <span id="total-price-display">0</span> VND</h3>
            <input type="hidden" id="total-price" value="0" name="total" />
            <button type="submit" class="btn btn-success" id="book-ticket-btn" name="redirect">Xác nhận đặt vé</button>
        </form>
    </div>

    <script>
        document.getElementById('food-select').addEventListener('change', updateTotalPrice);
        document.getElementById('drink-select').addEventListener('change', updateTotalPrice);
        document.getElementById('combo-select').addEventListener('change', updateTotalPrice);

        // Lắng nghe sự thay đổi của ghế
        document.querySelectorAll('.seat input[type="checkbox"]').forEach((checkbox) => {
            checkbox.addEventListener('change', updateTotalPrice);
        });

        function updateTotalPrice() {
            let total = 0;
            const selectedSeatIds = [];
            const selectedFoodIds = [];
            const selectedDrinkIds = [];
            const selectedComboIds = [];

            // Tính tổng giá tiền cho ghế
            document.querySelectorAll('.seat input[type="checkbox"]:checked').forEach((checkbox) => {
                total += parseInt(checkbox.getAttribute('data-price'));
                selectedSeatIds.push(checkbox.value);
            });

            // Tính tổng giá tiền cho thực phẩm (food)
            const selectedFood = document.getElementById('food-select').value;
            if (selectedFood) {
                const foodPrice = document.querySelector(`#food-select option[value="${selectedFood}"]`).getAttribute(
                    'data-price');
                total += parseInt(foodPrice);
                selectedFoodIds.push(selectedFood);
            }

            // Tính tổng giá tiền cho đồ uống (drink)
            const selectedDrink = document.getElementById('drink-select').value;
            if (selectedDrink) {
                const drinkPrice = document.querySelector(`#drink-select option[value="${selectedDrink}"]`).getAttribute(
                    'data-price');
                total += parseInt(drinkPrice);
                selectedDrinkIds.push(selectedDrink);
            }

            // Tính tổng giá tiền cho combo
            const selectedCombo = document.getElementById('combo-select').value;
            if (selectedCombo) {
                const comboPrice = document.querySelector(`#combo-select option[value="${selectedCombo}"]`).getAttribute(
                    'data-price');
                total += parseInt(comboPrice);
                selectedComboIds.push(selectedCombo);
            }

            // Cập nhật giá trị tổng tiền và danh sách đã chọn
            document.getElementById('total-price').value = total;
            document.getElementById('total-price-display').innerText = total.toLocaleString();
            document.getElementById('selected_seats').value = selectedSeatIds.join(',');
            document.getElementById('selected_foods').value = selectedFoodIds.join(',');
            document.getElementById('selected_drinks').value = selectedDrinkIds.join(',');
            document.getElementById('selected_combos').value = selectedComboIds.join(',');

            // Hiển thị ghế đã chọn
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
