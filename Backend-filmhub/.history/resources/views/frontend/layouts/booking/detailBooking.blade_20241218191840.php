@extends('frontend.layouts.master3')

<style>
    .bootstrap-select .dropdown-toggle {
        height: 50px;
        border: 2px solid black;
        border-radius: 10px;
        background-color: #f8f9fa;
        color: #495057;
    }

    .bootstrap-select .dropdown-menu {
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .bootstrap-select .dropdown-menu li a {
        color: #495057;
    }

    .bootstrap-select .dropdown-menu li a:hover {
        background-color: #2855a7;
        color: white;
    }
</style>
@section('content')
    <style>
        .custom-spacing {
            margin: 10px;
        }

        .select-row {
            display: flex;
            gap: 10px;
            /* Khoảng cách giữa các phần tử */
            align-items: center;
            /* Căn giữa theo chiều dọc (nếu cần) */
        }

        .select-row select {
            flex: 1;
            /* Đảm bảo cả hai phần tử chia sẻ không gian đều nhau */
        }


    </style>
    @if (session('error'))
        <script>
            alert('{{ session('error') }}');
        </script>
    @endif
    <form action="{{ route('vnpay_payment') }}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- @php
       dd(session('selected_seats','selected_seats_time'));
    @endphp --}}
        <input type="hidden" name="showtime_id" value="{{ $showtime->showtime_id }}">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <input type="hidden" name="total" value="{{ $totalAmount }}">
        <input type="hidden" name="selected_seats"
            value="{{ implode(',', $selectedSeats2->pluck('seat_id')->toArray()) }}">

        <!-- st top header Start -->
        <div class="st_bt_top_header_wrapper float_left">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="st_bt_top_back_btn float_left">
                            <a href="{{ route('getSeatBooking', $showtime->showtime_id) }}"><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;Back</a>
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
                                            <li><span class="dtts1">Ngày chiếu:</span>
                                                {{ \Carbon\Carbon::parse($showtime->datetime)->format('d/m/Y ') }}</li>
                                            <li><span class="dtts1">Ca chiếu:</span> <span class="dtts2">
                                                    {{ \Carbon\Carbon::parse($showtime->shifts->start_time)->format('H:i') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($showtime->shifts->end_time)->format('H:i') }}</span>
                                            </li>
                                            <li><span class="dtts1">Rạp chiếu:</span> <span
                                                    class="dtts2">{{ $showtime->rooms->theaters->name }}</span></li>
                                            <li><span class="dtts1">Ghế đã chọn:</span>
                                                <span class="dtts2">
                                                    @if ($selectedSeats2->isNotEmpty())
                                                        {{ implode(', ', $selectedSeats2->pluck('seat.seat_number')->toArray()) }}
                                                    @else
                                                        Không có ghế nào được chọn.
                                                    @endif
                                                </span>
                                            </li>
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
                                                <div class="mb-4">
                                                <label for="combo" class="form-label">Combo:</label>
                                                <select id="combo" name="combo_id[]" multiple class="selectpicker form-control"
                                                    onchange="updateTotalPrice()" data-live-search="true">
                                                    @foreach ($combos as $combo)
                                                        <option value="{{ $combo->id }}"
                                                            data-price="{{ $combo->price }}">
                                                            {{ $combo->name }} - {{ number_format($combo->price) }} VNĐ
                                                        </option>
                                                    @endforeach
                                                </select>
                                                </div>
                                                <div class="mb-4">
                                                <label for="food" class="form-label">Food:</label>
                                                <select id="food" name="food_id[]" multiple class="selectpicker form-control"
                                                    onchange="updateTotalPrice()" data-live-search="true">
                                                    @foreach ($foods as $food)
                                                        <option value="{{ $food->id }}" data-price="{{ $food->price }}">
                                                            {{ $food->name }} - {{ number_format($food->price) }} VNĐ
                                                        </option>
                                                    @endforeach
                                                </select>
                                                </div>
                                                <div class="mb-4">
                                                <label for="drink" class="form-label">Drink:</label>
                                                <select id="drink" name="drink_id[]" class="selectpicker form-control"
                                                    onchange="updateTotalPrice()" multiple data-live-search="true">
                                                    @foreach ($drinks as $drink)
                                                        <option value="{{ $drink->id }}" data-price="{{ $drink->price }}">
                                                            {{ $drink->name }} - {{ number_format($drink->price) }} VNĐ
                                                        </option>
                                                    @endforeach
                                                </select>
                                                </div>
                                                <div class="mb-4">
                                                <label for="Vourcher" class="form-label">Vourcher:</label>
                                                <select id="discount_code" name="discount_code" class="form-control"
                                                    onchange="updateTotalPrice()" data-live-search="true">
                                                    <option value="">Chọn mã giảm giá</option>
                                                    <optgroup label="Mã giảm giá thông thường">
                                                        @foreach($vouchers as $voucher)
                                                            @if (!in_array($voucher->id, $usedVoucher))
                                                                <option value="{{ $voucher->vourcher_code }}">
                                                                    {{ $voucher->vourcher_code }} ({{ $voucher->discount_percentage }}% giảm, tối đa {{ $voucher->max_discount_amount }} VNĐ)
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>

                                                    <!-- Hiển thị voucher sự kiện -->
                                                    <optgroup label="Mã giảm giá sự kiện">
                                                        @foreach($vourcherEvents as $event)
                                                            @if (!in_array($event->id, $usedVoucher))
                                                            <option value="{{ $event->vourcher_code }}">
                                                                {{ $event->vourcher_code }} ({{ $event->discount_percentage }}% giảm, tối đa {{ $event->max_discount_amount }} VNĐ)
                                                            </option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                                </div>
                                                @if (session('error'))
                                                    <div class="alert alert-danger">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="st_cherity_btn float_left">

                                        <ul>
                                            @if ($selectedSeats2->isNotEmpty())
                                                <li><button type="submit" class="btn btn-success"
                                                        onclick="startPayment()">Proceed to Pay</button></li>
                                            @else
                                                <li>
                                                    <p class="text-danger">Vui lòng chọn ghế trước khi thanh toán!</p>
                                                </li>
                                            @endif
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

                                            @if ($selectedSeats2->isNotEmpty())
                                                @foreach ($selectedSeats2 as $seat)
                                                    <li>{{ $seat->seat->seat_number }}<br>(1 Ticket) <span> Giá:
                                                            {{ number_format($totalAmount) }} VNĐ</span></li>
                                                @endforeach
                                            @else
                                                <li>Không có ghế nào được chọn.</li>
                                            @endif
                                        </ul>
                                        {{-- @if (isset($combo))
                                        <p>Combo đã chọn: <span>{{ $combo->name }}</span></p>
                                        <p>Giá combo: <span>{{ number_format($combo->price) }} VNĐ</span></p>
                                    @else
                                        <p>Không có combo nào được chọn.</p>
                                    @endif --}}
                                        {{-- <p>Booking Fees <span>Rs. 60.00</span></p>
                                    <p>Integrated GST (IGST) @ 18% <span>Rs. 60.00</span></p> --}}
                                    </div>
                                    <div class="st_dtts_sb_h2 float_left">
                                        <h3>Thành tiền: <span
                                                id="totalPriceDisplay">{{ number_format($totalAmount, 0, ',', '.') }}
                                                VNĐ</span></h3>
                                        <h4>Current State is <span>Kerala</span></h4>
                                        <h5>Số tiền phải trả <span
                                                id="totalAmountDisplay">{{ number_format($totalAmount, 0, ',', '.') }}
                                                VNĐ</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>









        <!-- st dtts section End -->
    </form>
@endsection

<script>
    function updateTotalPrice() {
        var totalPrice = {{ $totalAmount }}; // Giá hiện tại
        var comboSelect = document.getElementById('combo');
        var selectedOption = comboSelect.options[comboSelect.selectedIndex];
        var comboPrice = selectedOption.dataset.price ? parseFloat(selectedOption.dataset.price) : 0; // Giá combo

        totalPrice += comboPrice; // Cộng giá combo vào tổng

        var discountCode = document.getElementById('discount_code').value;

        // Giả sử bạn có thông tin mã giảm giá từ server
        var discounts = {};
        @foreach ($vouchers as $voucher)
            @if ($voucher->id !== $usedVoucher) // Chỉ thêm mã giảm giá chưa được sử dụng
                discounts["{{ $voucher->vourcher_code }}"] = {
                    percentage: {{ $voucher->discount_percentage }},
                    max: {{ $voucher->max_discount_amount }}
                };
            @endif
        @endforeach

        @foreach ($vourcherEvents as $event)
            discounts["{{ $event->vourcher_code }}"] = {
                percentage: {{ $event->discount_percentage }},
                max: {{ $event->max_discount_amount }}
            };
        @endforeach

        // Kiểm tra đối tượng discounts
        console.log(discounts);
        if (discountCode && discounts[discountCode]) {
            var discount = discounts[discountCode];
            var discountAmount = (totalPrice * discount.percentage) / 100;

            // Giảm theo số tiền tối đa
            if (discountAmount > discount.max) {
                discountAmount = discount.max;
            }

            // Đảm bảo tổng giá không giảm xuống dưới 0
            if (totalPrice - discountAmount < 0) {
                discountAmount = totalPrice; // Áp dụng giảm tối đa đến giá trị hiện tại
            }

            totalPrice -= discountAmount; // Áp dụng giảm giá
        }


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



    function startPayment() {

        alert('Nếu không hoàn thành thanh toán trong 5 phút, vé đã chọn sẽ bị xóa. Bạn muốn tiếp tục ?');
    }
</script>
