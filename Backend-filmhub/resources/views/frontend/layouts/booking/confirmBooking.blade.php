@extends('frontend.layouts.master4')

@section('content')
    <style>
        .st_calender_row_cont {
            border-bottom: none !important;
            box-shadow: none !important;
        }

        .st_calender_contant_main_wrapper {
            margin-bottom: 15px;
        }


        .st_bcc_tecket_bottom_left_wrapper {
            border: none !important;
            box-shadow: none !important;
        }
    </style>



    <!-- prs title wrapper Start -->

    <!-- prs title wrapper End -->

    <!-- st bc Start -->
    <div class="st_bcc_main_main_wrapper float_left">
        <div class="st_bcc_main_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="st_bcc_heading_wrapper float_left"> <i class="fa fa-check-circle"></i>
                            <h3>Payment Completed </h3>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="st_bcc_ticket_boxes_wrapper float_left">
                            <div class="st_bcc_tecket_top_hesder float_left">
                                <p>Your Booking is Confirmed!</p> <span>Booking ID {{ $ticket->ticket_id }} </span>
                            </div>
                            <div class="st_bcc_tecket_bottom_hesder float_left">
                                <div class="st_bcc_tecket_bottom_left_wrapper">
                                    <div class="st_bcc_tecket_bottom_inner_left">
                                        <div class="st_bcc_teckt_bot_inner_img">
                                            <img src="{{ Storage::url($movie->poster_url) }} " alt="img"
                                                style="width: 100px; height:100px">
                                        </div>
                                        <div class="st_bcc_teckt_bot_inner_img_cont">
                                            <h4>{{ $movie->title }}</h4>
                                            <h5>{{ $theater->name }}</h5>
                                            <h3>{{ \Carbon\Carbon::parse($showtime->datetime)->format('D, d M | h:i A') }}
                                            </h3>
                                            {{-- <h6>Carnival: Artech Central Mall,<br>
                                                Trivandrum Audi-5</h6> --}}
                                        </div>
                                        <div class="st_purchase_img" style="margin-bottom:50px">
                                            <img src="{{ asset('website/images/content/pur2.png') }}" alt="img">
                                        </div>
                                    </div>
                                    <div class="st_bcc_tecket_bottom_inner_right"> <i class="fas fa-chair"></i>
                                        <h3><br>
                                            <span>SEATS -
                                                @foreach ($ticket->ticketsSeats as $ticketSeat)
                                                    {{ $ticketSeat->seat->seat_number }},
                                                @endforeach
                                            </span>
                                        </h3>
                                    </div>
                                </div>

                                <div class="st_bcc_tecket_bottom_left_price_wrapper" style="margin-top: 30px !important">
                                    <h4>Total Amount</h4>
                                    <h5>{{ $ticket->total_price }} VND</h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
