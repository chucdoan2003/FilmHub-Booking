import React, { useEffect, useState } from "react";
import apiClient from "../api/apiClient";
import { useDispatch } from "react-redux";
import { selectShowTime } from "../redux/login/ticketSlice";
import { useNavigate, useParams } from "react-router-dom";
import dayjs from "dayjs";

import styles from "./index.module.css";
import "./Detail.css";

function Detail() {
  const dispatch = useDispatch();
  const navigate = useNavigate();

  const [movie, setMovie] = useState(null); // Movie details
  const [showtimes, setShowtimes] = useState([]); // Showtimes list

  const { id } = useParams(); // Movie ID from URL
  const movie_id = parseInt(id); // Ensure movie_id is an integer

  // Fetch movie and showtimes data
  useEffect(() => {
    const fetchData = async (movie_id) => {
      console.log("Calling API with movie_id:", movie_id); // Debug log
      try {
        const res = await apiClient.get(`/showtimes?movie_id=${movie_id}`);
        console.log("API Response:", res.data); // Debug log

        if (res.data.success) {
          // Lọc showtimes để chỉ hiển thị showtimes của movie_id hiện tại
          const filteredShowtimes = res.data.showtimes.filter(
            (st) => st.movie_id === movie_id
          );
          setShowtimes(filteredShowtimes); // Lưu danh sách showtimes đã lọc
          // Chỉ cần lấy movie của showtime đầu tiên (hoặc bạn có thể dùng movie_id khác nếu cần)
          setMovie(filteredShowtimes[0]?.movie || null);
        } else {
          console.error("No showtimes found");
        }
      } catch (error) {
        console.error("API call failed:", error);
      }
    };

    fetchData(movie_id);
  }, [movie_id]);

  console.log("Movie data:", movie);
  console.log("Showtimes data:", showtimes);

  // Select a showtime and navigate to the check page
  const onSelectShowTime = (data) => {
    console.log("Selected showtime:", data);

    const showTime = `${data.shift.start_time} - ${
      data.shift.end_time
    } Ngày ${dayjs(data.datetime).format("DD/MM/YYYY")}`;
    dispatch(
      selectShowTime({
        showTimeId: data.showtime_id,
        roomId: data.room_id,
        movieName: movie?.title || "Unknown",
        showTime,
        showTimePrice: data.value || 0,
        bookedSeats: data.booked_seats,
        rate: {
          normal: data.normal_price,
          vip: data.vip_price,
        },
      })
    );
    navigate("/check");
  };

  return (
    <div className="main-wrapper">
      {/* Breadcrumb */}
      <div className="breadcrumb-area breadcrumb-modify-padding bg-black-3">
        <div className="container">
          <div className="in-breadcrumb">
            <div className="row">
              <div className="col">
                <div className="breadcrumb-style-2">
                  <h2>{movie ? movie.title : "Loading..."}</h2>
                  <ul className="breadcrumb-list-2">
                    <li>{movie ? movie.release_date : "Loading..."}</li>
                    <li>{movie ? movie.duration + " mins" : "Loading..."}</li>
                    <li className="active">U/A 18+</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Movie Details */}
      <div className="movie-details-wrap section-ptb-50 bg-black grid grid-cols-12">
        {/* Movie Poster and Details */}
        <div className="container col-span-7">
          <div className="movie-details-video-content-wrap grid grid-cols-12 gap-3 mb-4">
            <div className="video-wrap col-span-4">
              {movie?.poster_url ? (
                <img
                  className="w-full h-full"
                  src={movie.poster_url}
                  alt={movie.title}
                />
              ) : (
                <p>Loading poster...</p>
              )}
            </div>
            <div className="movie-details-info col-span-8">
              <ul>
                <li>
                  <span>Director: </span>
                  {movie ? movie.director : "Loading..."}
                </li>
                <li>
                  <span>Starring: </span>
                  {movie ? movie.performer : "Loading..."}
                </li>
                <p>{movie ? movie.description : "Loading description..."}</p>
              </ul>
            </div>
          </div>

          {/* Showtime List */}
          <hr className="text-gray-400 mb-3" />
          <div className="time">
            <hr className="text-gray-400 my-3" />
            <div className="hour">
              <ul>
                {showtimes.map((showtime) => {
                  console.log("Rendering showtime:", showtime); // Debug log
                  return (
                    <li
                      key={showtime.showtime_id}
                      className={`border border-red-500 w-44 h-8 text-red-500 text-center rounded cursor-pointer ${styles.showTimeItem}`}
                      onClick={() => onSelectShowTime(showtime)}
                    >
                      {showtime.shift
                        ? `${showtime.shift.start_time} - ${showtime.shift.end_time}`
                        : "Loading..."}
                    </li>
                  );
                })}
              </ul>
            </div>
            <hr className="text-gray-400 my-3" />
          </div>
        </div>

        {/* Sidebar Section */}
        <div className="container col-span-5">
          <p>New Movie</p>
        </div>
      </div>
    </div>
  );
}

export default Detail;
