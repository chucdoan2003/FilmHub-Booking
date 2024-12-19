@extends('frontend.layouts.master')
@section('content')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
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
                <div class="col-lg-12 col-lg-12 col-lg-12 col-lg-12 d-flex justify-content-center" style="display: flex; justify-content: space-between;">
                    <div class="item">
                        <div class="prs_ms_trailer_slider_left_img_wrapper">
                            <img src="{{ Storage::url($movie->poster_url) }}" style="object-fit: contain;height: 468px;"
                                alt="vp_img">
                        </div>
                    </div>
                    <div class="prs_ms_trailer_slider_right_wrapper">
                        <h2 class="mb-2 performer">{{ $movie->title }}</h2>
                        <h3>{{ $movie->release_date }}</h3>
                        <h5 class="performer"><span>Starring -</span> {{ $movie->performer }}
                        </h5>
                        <ul>
                            <li>Duration - <span>{{ $movie->duration }} Phút</span>
                            </li>
                            <li>Directior - <span>{{ $movie->director }}</span>
                            </li>
                        </ul>
                        <!-- Phần đánh giá sao -->
                        <div class="star-rating mb-3 mt-2" style="direction: ltr;">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="fa {{ $i <= $movie->rating ? 'fa-star' : 'fa-star-o' }}"
                                    style="color: #f39c12; direction: ltr;"></span>
                            @endfor
                        </div>
                        <div class="mt-4 text-center">
                            <a class="text-white bg-danger py-2 px-5 rounded" href="/booking/{{ $movie->movie_id }}">Đặt
                                vé ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="prs_syn_main_section_wrapper mb-3">
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
    @include('frontend.movies.comments', ['movie_id' => $movie->id])
    {{-- End comment --}}

    @if ($relatedMovies)
        <div class="prs_ms_rm_main_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="prs_heading_section_wrapper">
                            <h2>Genre Related Movies</h2>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="prs_ms_rm_slider_wrapper">
                            <div class="owl-carousel owl-theme">
                                @foreach ($relatedMovies as $mv)
                                    <div class="item">
                                        <div class="prs_upcom_movie_box_wrapper">
                                            <div class="prs_upcom_movie_img_box">
                                                <img src="{{ Storage::url($mv->poster_url) }} " style="height: 350px;" alt="movie_img" />
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
            </div>
        </div>
    @endif
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

    <!-- prs related movie slider End -->
@endsection
