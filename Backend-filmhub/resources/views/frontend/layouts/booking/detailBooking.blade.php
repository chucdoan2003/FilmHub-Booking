@extends('frontend.layouts.master3')
@section('content')
<form action="{{route('vnpay_payment')}}" method="post" enctype="multipart/form-data" id="payment-form">
	@csrf

	<input type="hidden" name="showtime_id" value="{{ $showtime->showtime_id }}">
    <input type="hidden" name="user_id" value="{{$user_id}}">

    {{-- @php
    // Lấy thông tin từ cache, nếu không có thì trả về mảng rỗng
    $selectedSeats = Cache::get('selected_seats_' . session('user_id'), ['seats' => []])['seats'] ?? [];

    $selectedSeats = is_array($selectedSeats) ? $selectedSeats : [];
@endphp --}}
{{-- @php
    dd($selectedSeats);
@endphp --}}
    <input type="hidden" name="total" value="{{$totalPrice}}">
    <input type="hidden" name="selected_seats" value="{{ implode(',', $selectedSeats) }}">
    <!-- st top header Start -->
    <div class="st_bt_top_header_wrapper float_left">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="st_bt_top_back_btn float_left">
                        <a href="index.html"><i class="fas fa-long-arrow-alt-left"></i> &nbsp;Back</a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="st_bt_top_center_heading float_left">
                        <h3>{{ $showtime->movies->title }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- st top header Start -->

    <!-- st dtts section Start -->
    <div class="st_dtts_wrapper float_left">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="st_dtts_left_main_wrapper float_left">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="st_dtts_ineer_box float_left">
                                    <ul>
                                        <li><span class="dtts1">Ngày chiếu:</span> {{ \Carbon\Carbon::parse($showtime->datetime)->format('d/m/Y ') }}</li>
                                        <li><span class="dtts1">Ca chiếu:</span> <span class="dtts2">{{ $showtime->shifts->shift_name }}: {{ \Carbon\Carbon::parse($showtime->shifts->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($showtime->shifts->end_time)->format('H:i') }}</span></li>
                                        <li><span class="dtts1">Rạp chiếu:</span> <span class="dtts2">{{ $showtime->rooms->theaters->name }}</span></li>
                                        <li><span class="dtts1">Ghế đã chọn:</span> <span class="dtts2">{{ implode(', ', $seatNumbers->toArray()) }}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="st_cherity_section float_left">
                                    <div class="st_cherity_img float_left">
                                        {{-- <img src="images/content/cc1.jpg" alt="img"> --}}
                                    </div>
                                    <div class="st_cherity_img_cont float_left">
                                        <div class="box">
                                            {{-- <label for="combo">Chọn Combo:</label> --}}
                                            <select id="combo" name="combo_id" class="form-control"
                                                onchange="updateTotalPrice()">
                                                <option value="">Chọn combo</option>
                                                @foreach ($combos as $combo)
                                                    <option value="{{ $combo->id }}"
                                                        data-price="{{ $combo->price }}"
                                                        data-food-id="{{ $combo->comboFoodDrink->first()->food->id ?? '' }}"
                                                        data-drink-id="{{ $combo->comboFoodDrink->first()->drink->id ?? '' }}">
                                                        {{ $combo->name }} - {{ number_format($combo->price) }} VNĐ
                                                    </option>
                                                @endforeach
                                            </select>
                                            <!-- Input ẩn để lưu food_id và drink_id -->
                                            <input type="hidden" name="food_id" id="food_id" value="">
                                            <input type="hidden" name="drink_id" id="drink_id" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="st_cherity_btn float_left">
                                    <h3>SELECT TICKET TYPE</h3>
                                    <ul>
                                        {{-- <li><a href="#"><i class="flaticon-tickets"></i> &nbsp;M-Ticket</a></li>
                                        <li><a href="#"><i class="flaticon-tickets"></i> &nbsp;Box office Pickup</a></li> --}}
                                        <li><button type="submit" class="btn btn-success">Proceed to Pay</button></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="st_dtts_bs_wrapper float_left">
                                <div class="st_dtts_bs_heading float_left">
                                    <p>Booking summary</p>
                                </div>
                                <div class="st_dtts_sb_ul float_left">
                                    <ul id="selected-seats-list">
                                        @if (count($selectedSeats) > 0)
                                            @foreach ($selectedSeats as $seat)
                                                <li>{{ $seat }}<br>(1 Ticket) <span>Giá:
                                                        {{ number_format($totalPrice) }} VNĐ</span></li>
                                            @endforeach
                                        @else
                                            <li>Không có ghế nào được chọn.</li>
                                        @endif
                                    </ul>
                                    @if (isset($combo))
                                        <p>Combo đã chọn: <span>{{ $combo->name }}</span></p>
                                        <p>Giá combo: <span>{{ number_format($combo->price) }} VNĐ</span></p>
                                    @else
                                        <p>Không có combo nào được chọn.</p>
                                    @endif
                                    <p>Booking Fees <span>Rs. 60.00</span></p>
                                    <p>Integrated GST (IGST) @ 18% <span>Rs. 60.00</span></p>
                                </div>

                                <div class="st_dtts_sb_h2 float_left">
                                    <h3>Thành tiền: <span id="totalPriceDisplay">{{ number_format($totalPrice) }}
                                            VNĐ</span></h3>
                                    <h4>Current State is <span>Kerala</span></h4>
                                    <h5>Số tiền phải trả <span id="totalAmountDisplay">{{ number_format($totalPrice) }}
                                            VNĐ</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script>
        function updateTotalPrice() {
            var totalPrice = {{ $totalPrice }}; // Giá hiện tại
            var comboSelect = document.getElementById('combo');
            var selectedOption = comboSelect.options[comboSelect.selectedIndex];
            var comboPrice = selectedOption.dataset.price ? parseFloat(selectedOption.dataset.price) : 0; // Giá combo

            totalPrice += comboPrice; // Cộng giá combo vào tổng

            // Cập nhật giá thành hiển thị
            document.getElementById('totalPriceDisplay').innerText = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(totalPrice) + ' VNĐ';

            // Cập nhật số tiền phải trả hiển thị
            document.getElementById('totalAmountDisplay').innerText = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(totalPrice) + ' VNĐ';


            // Cập nhật giá tổng vào input
            document.querySelector('input[name="total"]').value = totalPrice;
            // Lưu food_id và drink_id vào các input ẩn
            var foodId = selectedOption.dataset.foodId;
            var drinkId = selectedOption.dataset.drinkId;

            document.querySelector('input[name="food_id"]').value = foodId;
            document.querySelector('input[name="drink_id"]').value = drinkId;

            // Cập nhật thông tin combo đã chọn
            var comboName = selectedOption.text;
            document.getElementById('selectedComboDisplay').innerText = comboName;
        }
    </script>
    <!-- st dtts section End -->
</form>
@endsection
