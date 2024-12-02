<!-- prs theater Slider Start -->
<?php

$topMovies = DB::table('tickets')->join('showtimes', 'tickets.showtime_id', '=', 'showtimes.showtime_id')->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')->select('movies.title as movie_title', DB::raw('COUNT(tickets.ticket_id) as total_tickets'))->groupBy('movies.title')->orderByDesc('total_tickets')->limit(10)->get();
?>
<div class="prs_theater_main_slider_wrapper">
    <div class="prs_theater_img_overlay"></div>
    <div class="prs_theater_sec_heading_wrapper">
        <h2>TOP 10 HOT MOVIES</h2>
    </div>
    <div class="wrap-album-slider">
        <ul class="album-slider">
            @foreach ($topMovies as $movie)
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <img src="{{ Storage::url($movies->poster_url) }}" style="height: 350px;"
                                    alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="prs_upcom_movie_img_btn_wrapper">
                                    <ul>
                                        <li><a href="#">View Trailer</a>
                                        </li>
                                        <li><a href="{{ route('movies.detail', $mv->movie_id) }}">View Details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="prs_upcom_movie_content_box">
                                <div class="prs_upcom_movie_content_box_inner">
                                    <h2><a href="{{ route('movies.detail', $mv->movie_id) }}">{{ $movie->title }}</a>
                                    </h2>
                                    <p>
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
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
            @endforeach
        </ul>
        <!-- End slider -->
    </div>
</div>
<!-- prs theater Slider End -->
