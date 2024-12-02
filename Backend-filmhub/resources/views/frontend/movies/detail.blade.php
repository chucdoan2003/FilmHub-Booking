@extends('frontend.layouts.master')
@section('content')
    <style>
        .performer {
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
    </style>

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
    <div class="prs_ms_trailer_vid_main_wrapper ">
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
                                        href='{{$movie->poster}}' title='title'><i
                                            class="flaticon-play-button"></i></a>
                                </li>
                            </ul>
                            <h2>View Trailer</h2>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-12 col-lg-12 col-lg-12 col-lg-12 d-flex justify-content-center">
                    <div class="item">
                        <div class="prs_ms_trailer_slider_left_img_wrapper">
                            <img src="{{ Storage::url($movie->poster_url) }}" style="object-fit: contain;height: 468px;"
                                alt="vp_img">
                        </div>
                    </div>
                    <div class="prs_ms_trailer_slider_right_wrapper">
                        <h2 class="mb-2">{{ $movie->title }}</h2>
                        <h3>{{ $movie->release_date }}</h3>
                        <h5 class="performer"><span>Starring -</span> {{ $movie->performer }}
                        </h5>
                        <ul>
                            <li>Duration - <span>{{ $movie->duration }} Phút</span>
                            </li>
                            <li>Directior - <span>{{ $movie->director }}</span>
                            </li>
                        </ul>
                        <div class="mt-4 text-center">
                            <a class="text-white bg-danger py-2 px-5 rounded" style="text-decoration: none" href="/booking/{{ $movie->movie_id }}">Đặt
                                vé ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    {{-- comment --}}
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-start align-items-center">
                                <img class="rounded-circle shadow-1-strong me-3"
                                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar"
                                    width="60" height="60" />
                                <div>
                                    <h6 class="fw-bold text-primary mb-1">Lily Coleman</h6>
                                    <p class="text-muted small mb-0">
                                        Shared publicly - Jan 2020
                                    </p>
                                </div>
                            </div>

                            <p class="mt-3 mb-4 pb-2">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip consequat.
                            </p>

                            <div class="small d-flex justify-content-start">
                                <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="far fa-thumbs-up me-2"></i>
                                    <p class="mb-0">Like</p>
                                </a>
                                <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="far fa-comment-dots me-2"></i>
                                    <p class="mb-0">Comment</p>
                                </a>
                                <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="fas fa-share me-2"></i>
                                    <p class="mb-0">Share</p>
                                </a>
                            </div>
                        </div>
                        <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                            <div class="d-flex flex-start w-100">
                                <img class="rounded-circle shadow-1-strong me-3"
                                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar"
                                    width="40" height="40" />
                                <div data-mdb-input-init class="form-outline w-100">
                                    <textarea class="form-control" id="textAreaExample" rows="4" style="background: #fff;"></textarea>
                                    <label class="form-label" for="textAreaExample">Message</label>
                                </div>
                            </div>
                            <div class="float-end mt-2 pt-1">
                                <button type="button" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-primary btn-sm">Post comment</button>
                                <button type="button" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-outline-primary btn-sm">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End comment --}}
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
