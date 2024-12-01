@extends('frontend.layouts.master')
@section('movies')
    <!-- prs title wrapper Start -->
    <div class="prs_title_main_sec_wrapper">
        <div class="prs_title_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_title_heading_wrapper">
                        <h2>{{ $movie->title }}</h2>
                        <ul>
                            <li><a href="/frontend">Home</a>
                            </li>
                            <li>&nbsp;&nbsp; >&nbsp;&nbsp; Movie Detail</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs title wrapper End -->
    <!-- prs ms trailer wrapper Start -->
    <div class="prs_ms_trailer_vid_main_wrapper">
        <div class="container">
            <div class="row">
                {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_heading_section_wrapper">
                        <h2>Movie Trailer</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-lg-12 col-lg-12 col-lg-12">
                    <div class="prs_ms_trailer_vid_wrapper">
                        <div class="prs_ms_trailer_vid_img_overlay"></div>
                        <div class="prs_ms_trailer_vid_icon_wrapper">
                            <ul>
                                <li><a class="test-popup-link button" rel='external'
                                        href='{{$movie->trailer}}' title='title'><i
                                            class="flaticon-play-button"></i></a>
                                </li>
                            </ul>
                            <h2>View Trailer</h2>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-12 col-lg-12 col-lg-12 col-lg-12">
                    <div class="prs_ms_trailer_slider_main_wrapper">
                        <div class="prs_ms_trailer_slider_left_wrapper">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="prs_ms_trailer_slider_left_img_wrapper">
                                        <img src="{{ Storage::url($movie->poster_url) }}"
                                            style="object-fit: contain;height: 468px;" alt="vp_img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="prs_ms_trailer_slider_right_wrapper">
                            <h2>{{ $movie->release_date }}</h2>
                            <p>{{ $movie->title }}</p>
                            <h5><span>Starring -</span> {{ $movie->performer }}
                            </h5>
                            <ul>
                                <li>Duration - <span>{{ $movie->duration }} Phút</span>
                                </li>
                                <li>Directior - <span>{{ $movie->director }}</span>
                                </li>
                            </ul>
                            <div>
                                <a href="">Đặt vé ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs ms trailer wrapper End -->
    <!-- prs syn Slider Start -->

    <div class="prs_syn_main_section_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="prs_syn_cont_wrapper">
                        <h3>Tóm tắt</h3>
                        <h4><span>Genre -</span>
                            @foreach ($movie->genres as $genre)
                                {{ $genre->name }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </h4>
                        <p>{{ $movie->description }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="prs_syn_img_wrapper">
                        <img src="{{ Storage::url($movie->poster_url) }}" alt="syn_img">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs syn Slider End -->
    <!-- prs related movie slider Start -->
    @if (!$directorRelatedMovies)
        <div class="prs_ms_rm_main_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="prs_heading_section_wrapper">
                            <h2>Director Related Movies</h2>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="prs_ms_rm_slider_wrapper">
                            <div class="owl-carousel owl-theme">
                                @foreach ($directorRelatedMovies as $directorRelated)
                                    <div class="item">
                                        <div class="prs_upcom_movie_box_wrapper">

                                            <div class="prs_upcom_movie_img_box">
                                                <img src="{{ Storage::url($directorRelated->poster_url) }}"
                                                    alt="movie_img" />
                                                <div class="prs_upcom_movie_img_overlay"></div>
                                                <div class="prs_upcom_movie_img_btn_wrapper">
                                                    <ul>
                                                        <li><a href="{{ $directorRelated->trailer }}">View Trailer</a>
                                                        </li>
                                                        <li><a
                                                                href="{{ route('frontend.movies.detail', $directorRelated->movie_id) }}">View
                                                                Details</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="prs_upcom_movie_content_box">
                                                <div class="prs_upcom_movie_content_box_inner">
                                                    <h2><a
                                                            href="{{ route('frontend.movies.detail', $directorRelated->movie_id) }}">{{ $directorRelated->title }}</a>
                                                    </h2>
                                                    <p>
                                                        @foreach ($directorRelated->genres as $genre)
                                                            {{ $genre->name }}@if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </p> <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="prs_upcom_movie_content_box_inner_icon">
                                                    <ul>
                                                        <li><a href="movie_booking.html"><i
                                                                    class="flaticon-cart-of-ecommerce"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- prs related movie slider End -->
@endsection
