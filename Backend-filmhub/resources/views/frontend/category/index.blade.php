@extends('frontend.layouts.master2')

@section('content')
    <style>
        .prs_upcom_movie_img_box {
            position: relative;
            height: 400px;
            /* Giới hạn chiều cao cho ảnh (tuỳ chỉnh theo ý muốn) */
            overflow: hidden;
            /* Ẩn phần ảnh thừa nếu vượt quá chiều cao */
            border-radius: 10px;
            /* Thêm bo góc nếu muốn */
        }

        .prs_upcom_movie_img_box img {
            width: 100%;
            /* Ảnh chiếm toàn bộ chiều rộng */
            height: 100%;
            /* Ảnh chiếm toàn bộ chiều cao của box */
            object-fit: cover;
            /* Giữ tỷ lệ ảnh và cắt bớt phần thừa */
            display: block;
            /* Đảm bảo ảnh hiển thị dưới dạng block */
        }


        .prs_upcom_movie_content_box_inner h2 a {
            display: -webkit-box;
            /* Dùng để tạo box cho nội dung */
            -webkit-line-clamp: 1;
            /* Số dòng giới hạn */
            -webkit-box-orient: vertical;
            /* Hướng dòng */
            overflow: hidden;
            /* Ẩn phần dư */
            text-overflow: ellipsis;
            /* Thêm dấu "..." */
            white-space: normal;
            /* Cho phép xuống dòng */
            word-break: break-word;
            /* Tự động ngắt từ nếu quá dài */
            font-size: 16px;
            /* Kích thước chữ */
            font-weight: bold;
            margin: 10px 0;
            color: #333;
            text-decoration: none;
        }

        .prs_upcom_movie_content_box_inner p {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Bạn có thể thay đổi số dòng ở đây nếu muốn */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            color: #888;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .prs_upcom_movie_content_box {
            min-height: 150px;
            /* Đặt chiều cao tối thiểu để các box bằng nhau */
        }


        /* List */
        .prs_mcc_list_movie_img_wrapper {
            height: 350px;
            /* Giới hạn chiều cao của ảnh */
            overflow: hidden;
            /* Ẩn phần thừa */
        }

        .prs_mcc_list_movie_img_wrapper img {
            width: 100%;
            /* Đảm bảo ảnh chiếm toàn bộ chiều rộng của phần chứa */
            height: 100%;
            /* Đảm bảo ảnh có chiều cao đầy đủ */
            object-fit: cover;
            /* Giữ tỷ lệ ảnh và không làm ảnh bị méo */
        }

        .prs_mcc_list_movie_img_cont_wrapper {
            height: 300px;
            /* Giới hạn độ cao cho phần thông tin */
            overflow: hidden;
            /* Ẩn phần thừa */
        }

        .prs_mcc_list_bottom_cont_wrapper {
            position: relative;
            /* Để các phần tử con có thể được căn chỉnh chính xác */
        }

        .prs_mcc_list_bottom_cont_wrapper p {
            max-height: 80px;
            /* Giới hạn chiều cao của phần mô tả */
            overflow: hidden;
            /* Ẩn phần thừa trong mô tả nếu nó quá dài */
            text-overflow: ellipsis;
            /* Thêm dấu '...' nếu mô tả quá dài */
        }

        .prs_mcc_list_left_cont_wrapper p,
        .prs_mcc_list_left_cont_wrapper h2,
        .prs_mcc_list_left_cont_wrapper h4 {
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }

        .prs_mcc_list_bottom_cont_wrapper {
            /* Giới hạn chiều cao cho phần mô tả bên dưới */
            overflow: hidden;
            /* Ẩn phần thừa nếu có */
        }

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

    @if ($movies->isEmpty())
        <div class="alert alert-warning">
            Không có phim nào trong danh mục này.
        </div>
    @endif
    <div class="prs_title_main_sec_wrapper">
        <div class="prs_title_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_title_heading_wrapper">
                        <h2>Movie Category</h2>
                        <ul>
                            <li><a href="/">Home</a>
                            </li>
                            <li>&nbsp;&nbsp; >&nbsp;&nbsp; Movie Category</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="prs_mc_category_sidebar_main_wrapper" style="margin-top: 50px !important">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="prs_mcc_left_side_wrapper">
                        <div class="prs_mcc_left_searchbar_wrapper">
                            <form action="{{ route('movies.search') }}" method="GET">
                                <input type="text" name="search" placeholder="Search Movie" />
                                <button type="submit"><i class="flaticon-tool"></i></button>
                            </form>
                        </div>
                        <div class="prs_mcc_bro_title_wrapper">
                            <h2>Danh mục</h2>
                            <ul>
                                @foreach ($genres as $genre)
                                    <li>
                                        <i class="fa fa-caret-right"></i> &nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('category.show', $genre->genre_id) }}">
                                            {{ $genre->name }}
                                            <span>{{ $genre->movies->count() }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="prs_mcc_right_side_wrapper">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 40px !important">
                                <div class="prs_mcc_right_side_heading_wrapper">

                                    <ul class="nav nav-pills">
                                        <li class="active"><a data-toggle="pill" href="#grid"><i
                                                    class="fa fa-th-large"></i></a>
                                        </li>
                                        {{-- <li><a data-toggle="pill" href="#list"><i class="fa fa-list"></i></a> --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                @if (session('error'))
                                <div class="alert alert-danger" style="margin-bottom: 20px !important">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if (session('msg'))
                            <div class="alert alert-success" style="margin-bottom: 20px !important">
                                {{ session('msg') }}
                            </div>
                        @endif
                        <div class="tab-content">
                            <div id="grid" class="tab-pane fade in active">
                                <div class="row">
                                    @foreach ($movies as $movie)
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 prs_upcom_slide_first">
                                            <div class="prs_upcom_movie_box_wrapper prs_mcc_movie_box_wrapper">
                                                <div class="prs_upcom_movie_img_box">
                                                    <img src="{{ Storage::url($movie->poster_url) }}" alt="movie_img" />
                                                    <div class="prs_upcom_movie_img_overlay"></div>
                                                    <div class="prs_upcom_movie_img_btn_wrapper">
                                                        <ul>
                                                            <li><a href="#" onclick="openTrailerModal('{{ $movie->trailer }}')">View Trailer</a></li>
                                                            <li><a href="{{ route('movies.detail', $movie->movie_id) }}">View Details</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="prs_upcom_movie_content_box">
                                                    <div class="prs_upcom_movie_content_box_inner">
                                                        <h2><a href="#">{{ $movie->title }}</a></h2>
                                                        <p>
                                                            @foreach ($movie->genres as $genre)
                                                                {{ $genre->name }}{{ !$loop->last ? ', ' : '' }}
                                                            @endforeach
                                                        </p>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= floor($movie->rating))
                                                                <i class="fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <div class="prs_upcom_movie_content_box_inner_icon">
                                                        <ul>
                                                            <li><a href="/booking/{{ $movie->movie_id }}"><i class="flaticon-cart-of-ecommerce"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Hiển thị nút chuyển trang -->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="pager_wrapper gc_blog_pagination">
                                            {{ $movies->links('pagination.custom-pagination') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
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
@endsection
