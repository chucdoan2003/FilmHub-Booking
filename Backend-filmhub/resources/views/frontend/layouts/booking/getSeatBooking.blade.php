@extends('frontend.layouts.master3')
@section('content')
    <style>
        body {
            background-color: rgb(46, 44, 61);
        }

        input.seat-checkbox:checked {
            background-color: red !important;
            color: white !important;
        }

        label.seat-label[for^="c"]:has(input:checked) {
            background-color: red !important;
            color: white !important;
        }

        input.seat-checkbox:disabled {
            background-color: grey !important;
            color: white !important;
        }

        label.seat-label[for^="c"]:has(input:disabled) {
            background-color: grey !important;
            color: white !important;
        }

        .timer {
            font-size: 20px;
            font-weight: bold;
            color: #ffffff;
            background-color: #ff0000;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    <!-- color picker start -->
    <!-- st top header Start -->
    {{-- <div class="timer">
        Thời gian còn lại: <span id="time-remaining">10:00</span>
    </div> --}}

    @if ($errors->any())
    <script>
        alert("{{ $errors->first() }}");
    </script>
@endif
    <form action="{{ route('detailBooking', $showtime->showtime_id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Thông tin ghế đã chọn -->
        <input type="hidden" name="selected_seats" id="selected-seats" value="">
        <!-- Tổng giá tiền -->
        <input type="hidden" name="total_price" id="total-price" value="">

        <div class="st_bt_top_header_wrapper float_left">
            <div class="container container_seat">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="st_bt_top_back_btn st_bt_top_back_btn_seatl float_left"> <a
                                href="{{ route('booking.index', $showtime->movies->movie_id) }}"><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;Back</a>
                        </div>
                        {{-- <div class="cc_ps_quantily_info cc_ps_quantily_info_tecket">
                            <p>Select Ticket</p>
                            <div class="select_number">
                                <button onclick="changeQty(1); return false;" class="increase"><i class="fa fa-plus"></i>
                                </button>
                                <input type="text" name="quantity" value="1" size="2" id="input-quantity"
                                    class="form-control" />
                                <button onclick="changeQty(0); return false;" class="decrease"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="hidden" name="product_id" />
                        </div> --}}
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="st_bt_top_center_heading st_bt_top_center_heading_seat_book_page float_left">
                            <!-- tên phim -->
                            <h3>{{ $showtime->movies->title }}</h3>

                            @php
                                $shiftStartTime = \Carbon\Carbon::parse($showtime->shifts->start_time);
                                $shiftEndTime = \Carbon\Carbon::parse($showtime->shifts->end_time);
                            @endphp
                            <!-- Ngày và ca chiếu -->
                            <h4>
                                Ngày chiếu: {{ \Carbon\Carbon::parse($showtime->datetime)->format('d/m/Y ') }},
                                Ca chiếu: {{ $showtime->shifts->shift_name }} : {{ $shiftStartTime->format('H:i') }} -
                                {{ $shiftEndTime->format('H:i') }}

                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="st_bt_top_close_btn st_bt_top_close_btn2 float_left"
                            style="margin-left:20px !important"> <a
                                href="{{ route('booking.index', $showtime->movies->movie_id) }}"><i
                                    class="fa fa-times"></i></a>
                        </div>
                        <div class="st_seatlay_btn float_left"> <button type="submit" class="btn btn-success"
                                style="margin-top:15px !important">Proceed to
                                Pay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- st top header Start -->
        <!-- st seat Layout Start -->
        <div class="st_seatlayout_main_wrapper float_left">
            <div class="container container_seat">
                <div class="st_seat_lay_heading float_left">
                    <!-- Tên rạp chiếu -->
                    <h3>{{ $showtime->rooms->theaters->name }}</h3>

                </div>
                <div class="st_seat_full_container">
                    <div class="st_seat_lay_economy_wrapper float_left">
                        <div class="screen">
                            <img src="{{ asset('website/images/content/screen.png') }}">
                        </div>
                        <div class="st_seat_lay_economy_heading float_left">
                            <h3>Economy</h3>
                        </div>
                        <!-- Danh sách ghế -->
                        @foreach ($showtime->rooms->rows as $row)
                            <div class="st_seat_lay_row float_left">
                                <ul>
                                    <li class="st_seat_heading_row">{{ $row->row_name }}</li>
                                    @foreach ($row->seats as $seat)
                                        @php
                                            $isBooked = in_array($seat->seat_id, $bookedSeats); // Kiểm tra xem ghế đã được đặt chưa
                                            $seatPrice =
                                                $seat->types->type_name == 'Ghế thường'
                                                    ? $showtime->normal_price
                                                    : $showtime->vip_price;
                                        @endphp
                                       <li style="background-color: {{ $isBooked ? 'red' : 'none' }} !important;">
                                        @if ($isBooked)
                                            <!-- Hiển thị thông báo "Ghế đã được đặt" nếu ghế đã chọn -->
                                            <span style="color: white;">Ghế đã được đặt</span>
                                        @else
                                            <!-- Nếu chưa chọn, hiển thị giá ghế -->
                                            <span>{{ number_format($seatPrice, 0, ',', '.') }} VNĐ</span>
                                        @endif

                                        <input type="checkbox" id="c{{ $seat->seat_id }}" name="selected_seats[]" value="{{ $seat->seat_id }}"
                                        class="seat-checkbox" data-price="{{ $seatPrice }}" @if ($isBooked) disabled @endif>
                                        <label for="c{{ $seat->seat_id }}" class="seat-label"
                                            data-seat-number="{{ $seat->seat_number }}"
                                            style="background-color: {{ $isBooked ? 'red' : 'none' }} !important;">
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

    </form>
    <!-- st seat Layout End -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Số lượng ghế đã chọn và tổng tiền -->
    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            const selectedSeatsInput = document.getElementById("selected-seats");
            const selectedSeats = selectedSeatsInput.value.trim(); // Lấy giá trị đã chọn từ input hidden

            // Kiểm tra nếu selected_seats là null, rỗng hoặc không có giá trị
            if (selectedSeats === "" || selectedSeats === null) {
                // Ngừng việc submit form và hiển thị cảnh báo
                event.preventDefault();
                alert("Vui lòng chọn ít nhất một ghế trước khi thanh toán.");

                // Quay lại trang trước đó sau khi hiển thị cảnh báo
                // window.history.back(); // Điều này sẽ quay lại trang trước trong trình duyệt
                return false; // Dừng việc submit form
            }

            const isConfirmed = confirm(
            "Sau khi chọn ghế, nếu không thanh toán sau 5 phút, ghế bạn đã chọn sẽ tự động bị bỏ . Bạn có chắc chắn muốn tiếp tục?"
        );

        if (!isConfirmed) {
            // Người dùng hủy thanh toán
            event.preventDefault();
            return false; // Ngăn form được gửi đi
        }
        });




        document.addEventListener("DOMContentLoaded", function() {
    const seatCheckboxes = document.querySelectorAll(".seat-checkbox");
    const selectedSeatsInput = document.getElementById("selected-seats");
    const totalPriceInput = document.getElementById("total-price");

    seatCheckboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function() {
            let totalPrice = 0; // Reset totalPrice mỗi lần thay đổi checkbox
            const selectedSeats = [];

            // Lặp qua tất cả các checkbox ghế
            seatCheckboxes.forEach(cb => {
                if (cb.checked) {
                    selectedSeats.push(cb.value); // Lưu các ghế đã chọn

                    const price = parseFloat(cb.getAttribute("data-price"));
                    if (!isNaN(price)) {
                        totalPrice += price; // Cộng giá ghế vào tổng tiền
                    }
                }
            });

            selectedSeatsInput.value = selectedSeats.join(","); // Cập nhật giá trị cho input hidden
            totalPriceInput.value = totalPrice.toFixed(0); // Đảm bảo tổng tiền là số nguyên
        });
    });
});


    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const labels = document.querySelectorAll(".seat-label");
            labels.forEach(label => {
                const seatNumber = label.getAttribute("data-seat-number");
                label.style.setProperty("--seat-content", `"${seatNumber}"`);
            });
        });
    </script>
    <script>
        //* Isotope js
        function protfolioIsotope() {
            if ($('.st_fb_filter_left_box_wrapper').length) {
                // Activate isotope in container
                $(".protfoli_inner, .portfoli_inner").imagesLoaded(function() {
                    $(".protfoli_inner, .portfoli_inner").isotope({
                        layoutMode: 'masonry',
                    });
                });

                // Add isotope click function
                $(".protfoli_filter li").on('click', function() {
                    $(".protfoli_filter li").removeClass("active");
                    $(this).addClass("active");
                    var selector = $(this).attr("data-filter");
                    $(".protfoli_inner, .portfoli_inner").isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 450,
                            easing: "linear",
                            queue: false,
                        }
                    });
                    return false;
                });
            };
        };
        protfolioIsotope();

        function changeQty(increase) {
            var qty = parseInt($('.select_number').find("input").val());
            if (!isNaN(qty)) {
                qty = increase ? qty + 1 : (qty > 1 ? qty - 1 : 1);
                $('.select_number').find("input").val(qty);
            } else {
                $('.select_number').find("input").val(1);
            }
        }
    </script>

{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        let countdownTime = 600; // 10 phút = 600 giây
        const timerElement = document.getElementById("time-remaining");

        function updateTimer() {
            const minutes = Math.floor(countdownTime / 60);
            const seconds = countdownTime % 60;

            // Cập nhật hiển thị
            timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            if (countdownTime <= 0) {
                // Hết thời gian, chuyển hướng về trang chủ
                alert("Hết thời gian! Bạn sẽ được chuyển về trang chủ.");
                window.location.href = "{{ route('movies.index') }}";
            } else {
                countdownTime--;
            }
        }

        // Cập nhật mỗi giây
        setInterval(updateTimer, 1000);
    });
</script> --}}
@endsection
