@extends('frontend.layouts.master')
@section('movies')
    <style>
        .movie-title,
        .movie-genre {
            white-space: nowrap;
            /* Không cho phép xuống dòng */
            overflow: hidden;
            /* Ẩn phần dư ra */
            text-overflow: ellipsis;
            /* Thêm dấu 3 chấm */
            display: block;
            /* Đảm bảo là block để áp dụng hiệu ứng */
            width: 100%;
            /* Giới hạn chiều rộng */
        }

        /* Modal xuất hiện với hiệu ứng */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            transition: opacity 0.3s ease;
        }

        /* Nội dung modal */
        .modal-content {
            position: relative;
            background-color: #fff;
            padding: 0;
            border-radius: 8px;
            width: 80%;
            max-width: 700px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        /* Video container */
        .video-container {
            width: 100%;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio */
            position: relative;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <!-- prs upcomung Slider Start -->
    <div class="prs_upcom_slider_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_heading_section_wrapper">
                        <h2>HOME</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_upcome_tabs_wrapper">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#best" aria-controls="best" role="tab"
                                    data-toggle="tab">Upcoming Movies</a>
                            </li>
                            <li role="presentation"><a href="#hot" aria-controls="hot" role="tab"
                                    data-toggle="tab">Relesed Movies</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="best">
                        <div class="prs_upcom_slider_slides_wrapper">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="row">
                                        @foreach ($movieUpcoming1 as $index => $mv)
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-3 prs_upcom_slide_first">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ Storage::url($mv->poster_url) }} "
                                                            style="height: 350px;" alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li>
                                                                    <a href="#"
                                                                        onclick="openTrailerModal('{{ $mv->trailer }}')">View
                                                                        Trailer</a>
                                                                </li>

                                                                <li><a href="{{ route('movies.detail', $mv->movie_id) }}">View
                                                                        Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2 class="movie-title"><a
                                                                    href="{{ route('movies.detail', $mv->movie_id) }}">{{ $mv->title }}</a>
                                                            </h2>

                                                            <p class="movie-genre">
                                                                @foreach ($mv->genres as $genre)
                                                                    {{ $genre->name }}@if (!$loop->last)
                                                                        ,
                                                                    @endif
                                                                @endforeach
                                                            </p>
                                                            <br>
                                          
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="/booking/{{ $mv->movie_id }}"><i
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
                                <div class="item">
                                    <div class="row">
                                        @foreach ($movieUpcoming2 as $index => $mv)
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mb-3 prs_upcom_slide_first">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ Storage::url($mv->poster_url) }} "
                                                            style="height: 350px;" alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li>
                                                                    <a href="#"
                                                                        onclick="openTrailerModal('{{ $mv->trailer }}')">View
                                                                        Trailer</a>
                                                                </li>

                                                                <li><a href="{{ route('movies.detail', $mv->movie_id) }}">View
                                                                        Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2 class="movie-title"><a
                                                                    href="{{ route('movies.detail', $mv->movie_id) }}">{{ $mv->title }}</a>
                                                            </h2>

                                                            <p class="movie-genre">
                                                                @foreach ($mv->genres as $genre)
                                                                    {{ $genre->name }}@if (!$loop->last)
                                                                        ,
                                                                    @endif
                                                                @endforeach
                                                            </p>
                                                            <br>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="prs_upcom_movie_content_box_inner_icon">
                                                            <ul>
                                                                <li><a href="/booking/{{ $mv->movie_id }}"><i
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
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_animate_btn1 prs_upcom_main_wrapper">
                                    <ul>
                                        <li><a href="#" class="button button--tamaya prs_upcom_main_btn"
                                                data-text="view all"><span>View All</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="hot">
                        <div class="prs_upcom_slider_slides_wrapper">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up8.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up7.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up6.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up5.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up4.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up3.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up2.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up1.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up1.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up2.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up3.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up4.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up5.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up6.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up7.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up8.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_animate_btn1 prs_upcom_main_wrapper">
                                    <ul>
                                        <li><a href="#" class="button button--tamaya prs_upcom_main_btn"
                                                data-text="view all"><span>View All</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="trand">
                        <div class="prs_upcom_slider_slides_wrapper">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up1.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up2.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up3.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up4.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up5.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up6.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up7.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up7.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up1.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 prs_upcom_slide_second">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up2.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up4.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                            <div class="prs_upcom_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ asset('website/images/content/up5.jpg') }}"
                                                        alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#">View Trailer</a>
                                                            </li>
                                                            <li><a href="#">View Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">Busting Car</a></h2>
                                                        <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        <div class="cc_featured_second_section">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up4.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up3.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up2.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                                                <div class="prs_upcom_movie_box_wrapper">
                                                    <div class="prs_upcom_movie_img_box">
                                                        <img src="{{ asset('website/images/content/up1.jpg') }}"
                                                            alt="movie_img" />
                                                        <div class="prs_upcom_movie_img_overlay"></div>
                                                        <div class="prs_upcom_movie_img_btn_wrapper">
                                                            <ul>
                                                                <li><a href="#">View Trailer</a>
                                                                </li>
                                                                <li><a href="#">View Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box">
                                                        <div class="prs_upcom_movie_content_box_inner">
                                                            <h2><a href="#">Busting Car</a></h2>
                                                            <p>Drama , Acation</p> <i class="fa fa-star"></i>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_animate_btn1 prs_upcom_main_wrapper">
                                    <ul>
                                        <li><a href="#" class="button button--tamaya prs_upcom_main_btn"
                                                data-text="view all"><span>View All</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="trailerModal" class="modal-overlay" onclick="closeTrailerModal()" style="display: none;">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="video-container">
                <iframe id="trailerFrame" src="" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <script>
        function openTrailerModal(trailerUrl) {
            // Hiển thị modal
            const modal = document.getElementById('trailerModal');
            const trailerFrame = document.getElementById('trailerFrame');

            modal.style.display = 'flex';
            trailerFrame.src = trailerUrl;

            // Ngăn cuộn khi modal mở
            document.body.style.overflow = 'hidden';
        }

        function closeTrailerModal() {
            // Ẩn modal
            const modal = document.getElementById('trailerModal');
            const trailerFrame = document.getElementById('trailerFrame');

            modal.style.display = 'none';
            trailerFrame.src = ''; // Xóa URL video để dừng phát

            // Khôi phục cuộn khi modal đóng
            document.body.style.overflow = 'auto';
        }

        // Ngăn trình duyệt cuộn lên đầu khi nhấn vào nút
        document.querySelectorAll('a[href="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(event) {
                event.preventDefault();
            });
        });
    </script>


    <!-- prs upcomung Slider End -->
@endsection
