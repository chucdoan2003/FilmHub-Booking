@extends('frontend.layouts.master2')
@section('content')
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
                            <div class="st_bcc_tecket_bottom_hesder float_left">
                                <div class="st_bcc_tecket_bottom_left_wrapper">
                                    <div class="st_bcc_tecket_bottom_inner_left">
                                        <div class="st_bcc_teckt_bot_inner_img">
                                            <img src="{{ Storage::url($item->poster_url) }}" alt="img" width="100px" height="100px">
                                        </div>
                                        <div class="st_bcc_teckt_bot_inner_img_cont">
                                            <h4>{{$item->title}}</h4>
                                            <h5>{{$item->theater}}</h5>
                                            <h3>{{$item->ticket_time}}</h3>
                                            <h6>{{$item->shift_name}} - Start: {{$item->shift_start}} to {{$item->shift_end}} </h6>
                                        </div>
                                        @if ($item->status = 'completed')
                                        <div class="st_purchase_img" style="margin-bottom: 100px !important;">
                                            <img src="{{ asset('website/images/content/pur2.png') }}" alt="img">
                                            {{-- sửa link ảnh  avt film --}}
                                        </div>
                                    @endif
                                    </div>
                                    <div class="st_bcc_tecket_bottom_inner_right">	<i class="fas fa-chair"></i>
                                        <h3>2 TICKETS <br>
                                        <span>
                                            @foreach($item->seats as $item2)
                                                {{$item2->seat_number}}

                                            @endforeach
                                            </span></h3>
                                    </div>
                                </div>
                                <div class="st_bcc_tecket_bottom_right_wrapper">
                                    <img src="{{asset('website/images/content/qr.png')}}" alt="img">
                                    <h4>Booking ID<br>{{$item->ticket_id}}</h4>
                                </div>
                                <div class="st_bcc_tecket_bottom_left_price_wrapper" style="margin-top:30px !important">
                                    <h4>Total Amount</h4>
                                    <h5>{{$item->total_price}} VNĐ</h5>
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
