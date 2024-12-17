@extends('frontend.layouts.master3')
@section('content')
    <!-- color picker start -->
    <!-- st top header Start -->
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
                                href="{{ route('booking.index', $showtime->movie->movie_id) }}"><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;Trở về</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="st_bt_top_center_heading st_bt_top_center_heading_seat_book_page float_left">
                            <!-- tên phim -->
                            <h3>{{ $showtime->movie->title }}</h3>

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
                            <div class="seat-legend">
                                <div class="seat-item">
                                    <div class="seat-icon seat-regular"></div>
                                    <span>Ghế thường</span>
                                </div>
                                <div class="seat-item">
                                    <div class="seat-icon seat-vip"></div>
                                    <span>Ghế VIP</span>
                                </div>
                                <div class="seat-item">
                                    <div class="seat-icon seat-disabled"></div>
                                    <span>Ghế đã đặt</span>
                                </div>
                                <div class="seat-item">
                                    <div class="seat-icon seat-selected"></div>
                                    <span>Ghế được chọn</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="st_bt_top_close_btn st_bt_top_close_btn2 float_left"
                            style="margin-left:20px !important"> <a
                                href="{{ route('booking.index', $showtime->movie->movie_id) }}"><i
                                    class="fa fa-times"></i></a>
                        </div>
                        <div class="st_seatlay_btn float_left"> <button type="submit" class="btn btn-success"
                                style="margin-top:15px !important">Thanh toán</button>
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
                    <h3>{{ $showtime->rooms->theater->name }}</h3>

                </div>
                <div class="st_seat_full_container">
                    <div class="st_seat_lay_economy_wrapper ">
                        <div class="screen">
                            <img src="{{ asset('website/images/content/screen.png') }}">
                        </div>
                        <div class="st_seat_lay_economy_heading ">
                            <h3>Danh sách ghế</h3>
                        </div>
                        <!-- Danh sách ghế -->
                        @foreach ($showtime->rooms->rows as $row)
                            @php
                                $seats = $row->seats; // Danh sách ghế trong hàng
                                $seatChunks = $seats->chunk(20); // Chia ghế thành từng nhóm 20 ghế
                            @endphp

                            @foreach ($seatChunks as $chunk)
                                <div class="st_seat_lay_row float_left">
                                    <ul>
                                        <li class="st_seat_heading_row">{{ $row->row_name }}</li>
                                        @foreach ($chunk as $seat)
                                            @php
                                                $isBooked = in_array($seat->seat_id, $bookedSeats);
                                                $isVip = $seat->types->type_name === 'VIP';
                                                $seatPrice = $isVip ? $showtime->vip_price : $showtime->normal_price;
                                            @endphp
                                            <li class="{{ $isVip ? 'vip' : 'normal-seat' }}"
                                                style="background-color: {{ $isBooked ? 'red' : 'transparent' }} !important;">
                                                @if ($isBooked)
                                                    <span style="color: white;">Ghế đã được đặt</span>
                                                @else
                                                    <span>{{ $seatPrice }} VNĐ</span>
                                                @endif
                                                <input type="checkbox" id="c{{ $seat->seat_id }}" name="selected_seats[]"
                                                    value="{{ $seat->seat_id }}" class="seat-checkbox"
                                                    data-price="{{ $seatPrice }}"
                                                    @if ($isBooked) disabled @endif>
                                                <label for="c{{ $seat->seat_id }}" class="seat-label"
                                                    data-seat-number="{{ $seat->seat_number }}"></label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
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
        });
        document.addEventListener("DOMContentLoaded", function() {
            const seatCheckboxes = document.querySelectorAll(".seat-checkbox");
            const selectedSeatsInput = document.getElementById("selected-seats");
            const totalPriceInput = document.getElementById("total-price");
            const maxSeats = 6; // Số lượng ghế tối đa mà người dùng có thể chọn

            seatCheckboxes.forEach((checkbox) => {
                checkbox.addEventListener("change", function() {
                    let totalPrice = 0; // Tổng tiền
                    const selectedSeatsByRow = {}; // Lưu danh sách ghế theo từng hàng

                    const rows = document.querySelectorAll(
                        ".st_seat_lay_row ul"); // Tất cả hàng ghế
                    rows.forEach((row) => {
                        const checkboxesInRow = row.querySelectorAll(".seat-checkbox");
                        const rowName = row.querySelector(".st_seat_heading_row")
                            .textContent.trim();
                        const seatsInRow = [];

                        // Thu thập trạng thái checkbox trong hàng
                        checkboxesInRow.forEach((cb, index) => {
                            if (cb.checked) {
                                seatsInRow.push(index); // Lưu index ghế
                                const price = parseFloat(cb.getAttribute(
                                    "data-price"));
                                if (!isNaN(price)) totalPrice += price;
                            }
                        });

                        if (seatsInRow.length > 0) {
                            selectedSeatsByRow[rowName] = seatsInRow;
                        }
                    });

                    const currentRow = checkbox.closest("ul"); // Hàng ghế chứa checkbox hiện tại
                    const checkboxesInCurrentRow = Array.from(
                        currentRow.querySelectorAll(".seat-checkbox")
                    );

                    // Kiểm tra ghế ở giữa bị bỏ chọn hoặc bỏ trống
                    for (const row in selectedSeatsByRow) {
                        const seats = selectedSeatsByRow[row];
                        seats.sort((a, b) => a - b); // Sắp xếp vị trí ghế trong hàng

                        for (let i = 0; i < seats.length - 1; i++) {
                            if (seats[i + 1] - seats[i] === 2) {
                                const isolatedSeatIndex = seats[i] + 1; // Ghế ở giữa bị bỏ trống
                                const isolatedCheckbox = checkboxesInCurrentRow[isolatedSeatIndex];

                                // Trường hợp bỏ chọn ghế ở giữa đã được chọn
                                if (!checkbox.checked && checkbox === isolatedCheckbox) {
                                    alert(
                                        "Bạn không thể bỏ ghế ở giữa khi nó nằm giữa 2 ghế đã chọn!"
                                    );
                                    checkbox.checked = true; // Khôi phục trạng thái
                                    return;
                                }

                                // Trường hợp chọn ghế làm trống ghế ở giữa
                                if (checkbox.checked && isolatedCheckbox && !isolatedCheckbox
                                    .checked) {
                                    alert("Bạn không được để ghế trống ở giữa. Vui lòng chọn lại!");
                                    checkbox.checked = false; // Hủy chọn ghế hiện tại
                                    return;
                                }
                            }
                        }
                    }

                    // Kiểm tra số lượng ghế tối đa
                    let totalSelectedSeats = 0;
                    for (const row in selectedSeatsByRow) {
                        totalSelectedSeats += selectedSeatsByRow[row].length;
                    }
                    if (totalSelectedSeats > maxSeats) {
                        alert(`Bạn chỉ được chọn tối đa ${maxSeats} ghế.`);
                        checkbox.checked = false; // Hủy chọn ghế hiện tại
                        return;
                    }

                    // Cập nhật input hidden
                    selectedSeatsInput.value = JSON.stringify(selectedSeatsByRow);
                    totalPriceInput.value = totalPrice.toFixed(0);
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
@endsection
