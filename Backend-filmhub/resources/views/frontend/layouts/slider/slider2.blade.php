<!-- prs theater Slider Start -->
<div class="prs_theater_main_slider_wrapper">
    <div class="prs_theater_img_overlay"></div>
    <div class="prs_theater_sec_heading_wrapper">
        <h2>TOP MOVIES IN THEATRES</h2>
    </div>
    <div class="wrap-album-slider">
        <ul class="album-slider">
            @php
                $topMovies = DB::table('movies')
                    ->leftJoin('showtimes', 'movies.movie_id', '=', 'showtimes.movie_id')
                    ->leftJoin('tickets', 'showtimes.showtime_id', '=', 'tickets.showtime_id')
                    ->leftJoin('genre_movie', 'movies.movie_id', '=', 'genre_movie.movie_id')
                    ->leftJoin('genres', 'genre_movie.genre_id', '=', 'genres.genre_id')
                    ->select(
                        'movies.movie_id',
                        'movies.title',
                        'movies.description',
                        'movies.poster_url',
                        'movies.rating',
                        'movies.trailer',
                        DB::raw('GROUP_CONCAT(genres.name SEPARATOR ", ") as genres'),
                        DB::raw('COUNT(tickets.ticket_id) as total_tickets'),
                    )
                    ->groupBy(
                        'movies.movie_id',
                        'movies.title',
                        'movies.description',
                        'movies.poster_url',
                        'movies.rating',
                        'movies.trailer',
                    )
                    ->orderByDesc('total_tickets')
                    ->limit(10)
                    ->get();
            @endphp
            @foreach ($topMovies as $mv)
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <img src="{{ Storage::url($mv->poster_url) }} " style="height: 300px;" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="prs_upcom_movie_img_btn_wrapper">
                                    <ul>
                                        <li>
                                            <a href="#" onclick="openTrailerModal('{{ $mv->trailer }}')">View
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
                                        @if (!empty($movie->genres))
                                            <p><strong>Genres:</strong> {{ $movie->genres }}</p>
                                        @else
                                            <p><strong>Genres:</strong> Not available</p>
                                        @endif
                                    </p>
                                    <div class="star-rating" style="direction: ltr;">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="fa {{ $i <= $mv->rating ? 'fa-star' : 'fa-star-o' }}"
                                                style="color: #f39c12;"></span>
                                        @endfor
                                    </div>
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
            @endforeach
        </ul>
        <!-- End slider -->
    </div>
</div>
<!-- prs theater Slider End -->
