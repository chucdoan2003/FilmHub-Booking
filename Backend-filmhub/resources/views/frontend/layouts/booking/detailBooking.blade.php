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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <form action="{{ route('vnpay_payment') }}" method="post" enctype="multipart/form-data" id="payment-form">
        @csrf

        <input type="hidden" name="showtime_id" value="{{ $showtime->showtime_id }}">
        <input type="hidden" name="user_id" value="{{ $user_id }}">


        <input type="hidden" name="total" value="{{ $totalPrice }}">
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
                                            <li><span class="dtts1">Ngày chiếu:</span>
                                                {{ \Carbon\Carbon::parse($showtime->datetime)->format('d/m/Y ') }}</li>
                                            <li><span class="dtts1">Ca chiếu:</span> <span
                                                    class="dtts2">{{ $showtime->shifts->shift_name }}:
                                                    {{ \Carbon\Carbon::parse($showtime->shifts->start_time)->format('H:i') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($showtime->shifts->end_time)->format('H:i') }}</span>
                                            </li>
                                            <li><span class="dtts1">Rạp chiếu:</span> <span
                                                    class="dtts2">{{ $showtime->rooms->theaters->name }}</span></li>
                                            <li><span class="dtts1">Ghế đã chọn:</span> <span
                                                    class="dtts2">{{ implode(', ', $seatNumbers->toArray()) }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="st_cherity_section float_left">
                                        
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
                                        <h3>SELECT TICKET TYPE</h3>
                                        <ul>
                                            <li><a href="#"><i class="flaticon-tickets"></i> &nbsp;M-Ticket</a></li>
                                            <li><a href="#"><i class="flaticon-tickets"></i> &nbsp;Box office
                                                    Pickup</a></li>
                                            <li><button type="submit" class="btn btn-success">Proceed to Pay</button></a>
                                            </li>
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
                                        <p>Combo đã chọn: <span id="selected-combo-name">{{ isset($combo) ? $combo->name : 'Không có combo nào được chọn.' }}</span></p>
                                        <p>Giá combo: <span id="selected-combo-price">{{ isset($combo) ? number_format($combo->price) : '0 VNĐ' }}</span></p>
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
        <!-- st dtts section End -->
    </form>
@endsection
<script>
    function updateTotalPrice() {
    var totalPrice = {{ $totalPrice }}; // Giá hiện tại
    var comboSelect = document.getElementById('combo');
    var foodSelect = document.getElementById('food');
    var drinkSelect = document.getElementById('drink');
    var selectedOptions = Array.from(comboSelect.selectedOptions);
    var comboPrice = 0;
    var selectedComboName = '';

     // Tính tổng giá combo
     if (selectedOptions.length > 0) {
        selectedOptions.forEach(option => {
            comboPrice += parseFloat(option.dataset.price || 0); // Cộng giá từng combo
            selectedComboName = option.text; // Lưu tên combo
        });
    } else {
        selectedComboName = 'Không có combo nào được chọn.'; // Cập nhật thông báo khi không chọn combo
    }

    totalPrice += comboPrice; // Cộng giá combo vào tổng

     // Cộng giá món ăn
     if (foodSelect.value) {
        var selectedFood = foodSelect.options[foodSelect.selectedIndex];
        totalPrice += parseFloat(selectedFood.dataset.price || 0);
    }

    // Cộng giá đồ uống
    if (drinkSelect.value) {
        var selectedDrink = drinkSelect.options[drinkSelect.selectedIndex];
        totalPrice += parseFloat(selectedDrink.dataset.price || 0);
    }


    var discountCode = document.getElementById('discount_code').value;

    // Giả sử bạn có thông tin mã giảm giá từ server
    var discounts = {};
    @foreach($vouchers as $voucher)
        @if ($voucher->id !== $usedVoucher)
            discounts["{{ $voucher->vourcher_code }}"] = {
                percentage: {{ $voucher->discount_percentage }},
                max: {{ $voucher->max_discount_amount }}
            };
        @endif
    @endforeach

    @foreach($vourcherEvents as $event)
        discounts["{{ $event->vourcher_code }}"] = {
            percentage: {{ $event->discount_percentage }},
            max: {{ $event->max_discount_amount }}
        };
    @endforeach

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
    
    // Cập nhật thông tin combo đã chọn
    document.getElementById('selected-combo-name').innerText = selectedComboName;
    document.getElementById('selected-combo-price').innerText = number_format(comboPrice) + ' VNĐ';

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

    // Cập nhật thông tin combo đã chọn
    updateSelectedCombos(selectedOptions);
}
function number_format(number) {
    return new Intl.NumberFormat('vi-VN').format(number);
}
$(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

