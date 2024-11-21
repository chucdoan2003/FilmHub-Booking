import React, { useEffect } from "react";
import "./Detail.css";
import { useDispatch, useSelector } from "react-redux";
import { fetchMovieError, fetchMovieStart, fetchMovieSuccess } from "../redux/login/movieSlice";

const MoviesPage = () => {
  const dispatch = useDispatch();
  const { movieData, cinemas, loading, error } = useSelector((state) => state.movies);

  useEffect(() => {
    dispatch(fetchMovieStart());

    fetch("http://127.0.0.1:8000/api/movies")
      .then((response) => response.json())
      .then((data) => {
        if (data.data && data.data.length > 0) {
          dispatch(fetchMovieSuccess({ movie: data.data, cinemas: data.cinemas }));
        } else {
          dispatch(fetchMovieError("Dữ liệu không đầy đủ"));
        }
      })
      .catch((err) => {
        dispatch(fetchMovieError(err.message));
      });
  }, [dispatch]);

  return (
    <div>
      <h2>Danh sách phim</h2>
      {loading && <p>Đang tải...</p>}
      {error && <p style={{ color: "red" }}>Có lỗi xảy ra khi tải phim. Vui lòng thử lại.</p>}
      <div>
        {movieData && movieData.length > 0 ? (
          movieData.map((movie) => (
            <div key={movie.movie_id} className="movie-item">
              {/* Poster */}
              <div className="video-wrap">
                <img
                  id="moviePoster"
                  src={`http://127.0.0.1:8000/${movie.poster_url}`}
                  alt={`Poster for ${movie.title}`}
                />
              </div>

              {/* Movie Details */}
              <h3>{movie.title}</h3>
              <p><strong>Mô tả:</strong> {movie.description}</p>
              <p><strong>Thời lượng:</strong> {movie.duration} phút</p>
              <p><strong>Ngày phát hành:</strong> {movie.release_date}</p>
              <p><strong>Đánh giá:</strong> {movie.rating || "Chưa có"}</p>
              <p><strong>Trạng thái:</strong> {movie.status || "Chưa cập nhật"}</p>
              <p><strong>Đạo diễn:</strong> {movie.director || "Không rõ"}</p>
              <p><strong>Diễn viên:</strong> {movie.performer || "Không rõ"}</p>
              <p>
                <strong>Trailer:</strong>{" "}
                {movie.trailer ? (
                  <a href={movie.trailer} target="_blank" rel="noopener noreferrer">
                    Xem trailer
                  </a>
                ) : (
                  "Không có"
                )}
              </p>
              <p><strong>Ngày tạo:</strong> {movie.created_at}</p>
              <p><strong>Cập nhật lần cuối:</strong> {movie.updated_at}</p>
            </div>
          ))
        ) : (
          <p>Không có phim nào.</p>
        )}
      </div>
    </div>
  );
};

export default MoviesPage;
