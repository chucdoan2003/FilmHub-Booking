@extends('frontend.layouts.master2')

@section('content')
<style>
.st_calender_row_cont {
    border-bottom: none !important;
    box-shadow: none !important;
}

.st_calender_contant_main_wrapper {
    margin-bottom: 15px;
}
</style>
    <div class="prs_title_main_sec_wrapper">
        <div class="prs_title_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_title_heading_wrapper">
                        <h2>Movie Booking</h2>
                        <ul>
                            <li><a href="#">Home</a>
                            </li>
                            <li>&nbsp;&nbsp; >&nbsp;&nbsp; Movie Bookin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs title wrapper End -->
    <!-- prs video top Start -->
    {{-- <div class="prs_booking_main_div_section_wrapper">
<div class="prs_top_video_section_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="st_video_slider_inner_wrapper float_left">
                    <div class="st_video_slider_overlay"></div>
                    <div class="st_video_slide_sec float_left">
                        <a rel='external' href='https://www.youtube.com/embed/ryzOXAO0Ss0' title='title' class="test-popup-link">
                            <img src="images/index_III/icon.png" alt="img">
                        </a>
                        <h3>Aquaman</h3>
                        <p>ENGLISH, HINDI, TAMIL</p>
                        <h4>ACTION | Adventure | Fantasy</h4>
                        <h5><span>2d</span> <span>3d</span> <span>D 4DX</span> <span>Imax 3D</span></h5>
                    </div>
                    <div class="st_video_slide_social float_left">
                    <div class="st_slider_rating_btn_heart st_slider_rating_btn_heart_5th">
                            <h5><i class="fa fa-heart"></i> 85%</h5>
                            <h4>52,291 votes</h4>
                        </div>
                        <div class="st_video_slide_social_left float_left">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook-f"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="st_video_slide_social_right float_left">
                            <ul>
                                <li data-animation="animated fadeInUp" class=""><i class="far fa-calendar-alt"></i> 14 Dec, 2022</li>
                                <li data-animation="animated fadeInUp" class=""><i class="far fa-clock"></i> 2 hrs 23 mins</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <!-- prs video top End -->
    <!-- st slider rating wrapper Start -->
    @php
        $displayedDates = [];
    @endphp
    <div class="st_slider_rating_main_wrapper float_left">
        <div class="container">
            <div class="st_calender_tabs">
                <ul class="nav nav-tabs">
                    @foreach ($showtimesGroupedByDate as $date => $showtimesOnDate)
                        @php
                            $formattedDate = \Carbon\Carbon::parse($date)->format('Ymd');
                        @endphp
                        <li class="{{ $date == $selectedDate ? 'active' : '' }}">
                            <a href="{{ route('booking.index', ['id' => $movieId, 'selected_date' => $date]) }}">
                                <span>{{ \Carbon\Carbon::parse($date)->format('D') }}</span><br>
                                {{ \Carbon\Carbon::parse($date)->format('d') }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


    <!-- st slider rating wrapper End -->
    <!-- st slider sidebar wrapper Start -->
    <div class="st_slider_index_sidebar_main_wrapper st_slider_index_sidebar_main_wrapper_booking float_left">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="st_indx_slider_main_container float_left">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="home" class="tab-pane active">
                                    <!-- Nội dung showtimes sẽ được hiển thị tại đây -->
                                    @php
                                        $currentDate = null;
                                        $groupedShowtimes = $selectedShowtimes->groupBy(function ($showtime) {
                                            return date('Y-m-d', strtotime($showtime->show_date)); // Nhóm theo ngày
                                        });
                                    @endphp

                                    @foreach ($groupedShowtimes as $showDate => $showtimes)
                                        <div class="st_calender_contant_main_wrapper float_left showtime-item ">
                                            <h3>{{ date('l, F d, Y', strtotime($showDate)) }}</h3><br>

                                            @php
                                                // Group showtimes by theater
                                                $groupedByTheater = $showtimes->groupBy('theater_name');
                                            @endphp

                                            @foreach ($groupedByTheater as $theaterName => $showtimesInTheater)
                                                <div class="st_calender_row_cont float_left">
                                                    <div class="st_calender_asc">
                                                        <div class="st_calen_asc_heart">
                                                            <a href="#"><i class="fa fa-heart"></i></a>
                                                        </div>
                                                        <div class="st_calen_asc_heart_cont">
                                                            <h3>{{ $theaterName }} - Phòng
                                                                {{ $showtimesInTheater->first()->room_name }}</h3>
                                                        </div>
                                                    </div>

                                                    <div class="st_calen_asc_tecket_time_select">
                                                        <ul>
                                                            @foreach ($showtimesInTheater as $showtime)
                                                                <li>
                                                                    <span>
                                                                        <h4>Giá thường: {{ $showtime->normal_price }}</h4>
                                                                        <h4>Giá vip: {{ $showtime->vip_price }}</h4>
                                                                    </span>
                                                                    <a href="">{{ date('h:i A', strtotime($showtime->start_time)) }}</a>

                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="prs_mcc_left_side_wrapper">
                        <div class="prs_mcc_left_searchbar_wrapper">
                            <input type="text" placeholder="Search Movie">
                            <button><i class="flaticon-tool"></i>
                            </button>
                        </div>
                        <div class="prs_mcc_bro_title_wrapper">
                            <h2>browse title</h2>
                            <ul>
                                <li><i class="fa fa-caret-right"></i> &nbsp;&nbsp;&nbsp;<a href="#">All
                                        <span>23,124</span></a>
                                </li>
                                <li><i class="fa fa-caret-right"></i> &nbsp;&nbsp;&nbsp;<a href="#">Action
                                        <span>512</span></a>
                                </li>
                                <li><i class="fa fa-caret-right"></i> &nbsp;&nbsp;&nbsp;<a href="#">Romantic
                                        <span>548</span></a>
                                </li>
                                <li><i class="fa fa-caret-right"></i> &nbsp;&nbsp;&nbsp;<a href="#">Love
                                        <span>557</span></a>
                                </li>
                                <li><i class="fa fa-caret-right"></i> &nbsp;&nbsp;&nbsp;<a href="#">Musical
                                        <span>554</span></a>
                                </li>
                                <li><i class="fa fa-caret-right"></i> &nbsp;&nbsp;&nbsp;<a href="#">Drama
                                        <span>567</span></a>
                                </li>
                                <li><i class="fa fa-caret-right"></i> &nbsp;&nbsp;&nbsp;<a href="#">Thriller
                                        <span>689</span></a>
                                </li>
                                <li><i class="fa fa-caret-right"></i> &nbsp;&nbsp;&nbsp;<a href="#">Horror
                                        <span>478</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="prs_mcc_event_title_wrapper">
                            <h2>Top Events</h2>
                            <img src="images/content/movie_category/event_img.jpg" alt="event_img">
                            <h3><a href="#">Music Event in india</a></h3>
                            <p>Pune <span><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i
                                        class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span>
                            </p>
                            <h4>June 07 <span>08:00-12:00 pm</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
