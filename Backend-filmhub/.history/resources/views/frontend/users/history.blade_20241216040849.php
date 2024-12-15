    @extends('frontend.layouts.master2')
    @section('content')
        <style>
            .ticket-divider {
                border: 1px solid #ccc;
                /* Thêm đường kẻ dưới với màu sắc và độ dày tùy chỉnh */
                padding-bottom: 20px;
                /* Thêm khoảng cách giữa nội dung và đường kẻ dưới */
                margin-bottom: 20px;
                /* Khoảng cách dưới mỗi vé */
            }
        </style>
        <div class="st_bcc_main_main_wrapper float_left">
            <div class="st_bcc_main_wrapper" style="padding-top:0px;">
                <div class="container">
                    <div class="row">
                        {{-- <div class="col-md-12">
                        <div class="st_bcc_heading_wrapper float_left">	<i class="fa fa-check-circle"></i>
                            <h3>Payment of <span>Rs 373.00</span> Complete successfull</h3>
                        </div>
                    </div> --}}
                        <div class="col-md-12">
                            <div class="st_bcc_ticket_boxes_wrapper float_left">
                                <div class="st_bcc_tecket_top_hesder float_left">
                                    <p>Your tickets booked !!!</p>
                                </div>
                                @foreach ($tickets as $item)
                                    <div class="st_bcc_tecket_bottom_hesder float_left ticket-divider"
                                        style="margin-bottom:30px !important;">
                                        <div class="st_bcc_tecket_bottom_left_wrapper" style="position: relative;">
                                            <div class="st_bcc_tecket_bottom_inner_left">
                                                <style>
                                                    .st_bcc_tecket_bottom_left_wrapper:after {
                                                        content: none;
                                                        /* Loại bỏ đường kẻ dưới */
                                                    }
                                                </style>
                                                <div class="st_bcc_teckt_bot_inner_img">
                                                    <img src="{{ Storage::url($item->poster_url) }}" alt="img"
                                                        width="100px" height="100px">
                                                </div>
                                                <div class="st_bcc_teckt_bot_inner_img_cont">
                                                    <h4>{{ $item->title }}</h4>
                                                    <h5>{{ $item->theater }}</h5>

                                                    <h6> Thời gian : {{ $item->datetime }} <br>
                                                        Start: {{ $item->shift_start }} to
                                                        {{ $item->shift_end }} </h6>

                                                        @if ($item->food_id)
                                                        <h6>Đồ ăn: {{ $item->food_name }}</h6>
                                                    @endif

                                                    <!-- Hiển thị thông tin Drink -->
                                                    @if ($item->drink_id)
                                                        <h6>Thức uống: {{ $item->drink_name }}</h6>
                                                    @endif

                                                    <!-- Hiển thị thông tin Combo -->
                                                    @if ($item->combo_id)
                                                        <h6>Combo: {{ $item->combo_name }}</h6>
                                                    @endif
                                                </div>
                                                @if ($item->status = 'completed')
                                                    <div class="st_purchase_img" style="margin-bottom: 10px !important;">
                                                        <img src="{{ asset('website/images/content/pur2.png') }}"
                                                            alt="img">
                                                        {{-- sửa link ảnh  avt film --}}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="st_bcc_tecket_bottom_inner_right"> <i class="fas fa-chair"></i>
                                                <h3> SEATS <br>
                                                    <span>
                                                        @foreach ($item->seats as $item2)
                                                            {{ $item2->seat_number }}
                                                        @endforeach
                                                    </span>
                                                </h3>
                                            </div>
                                        </div>

                                        <div class="st_bcc_tecket_bottom_right_wrapper">
                                            <!-- Tạo QR Code theo ticket_id -->
                                            <div>
                                                {!! QrCode::size(100)->generate(route('admin.tickets.show', ['ticket' => $item->ticket_id])) !!}
                                            </div>
                                            <h4>Booking ID<br />{{ $item->ticket_id }}</h4>
                                            <h4>{{ $item->ticket_time }}</h4>
                                        </div>

                                        <div class="st_bcc_tecket_bottom_left_price_wrapper"
                                            style="margin-top:10px !important">
                                            <h4>Total Amount</h4>
                                            <h5>{{ number_format($item->total_price, 0, ',', '.') }} VND</h5>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            {{-- <div class="st_bcc_ticket_boxes_bottom_wrapper float_left">
                            <p>You can access your ticket from your Profile. We will send you
                                <br>an e-Mail/SMS Confirmation with in 15 Minutes.</p>
                            <ul>
                                <li><a href="#">INVITE FRIENDS</a>
                                </li>
                                <li><a href="#">Locate Friend</a>
                                </li>
                            </ul>
                        </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
