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

  // const [showVideo, setShowVideo] = useState(false);
  const [movie, setMovie] = useState(null);
  const [showtimes, setShowtimes] = useState([]);

  const { id } = useParams();

  // const toggleVideo = () => {
  //   setShowVideo(!showVideo);
  // };

  useEffect(() => {
    const fetchData = async (movie_id) => {
      try {
        const res = await apiClient.get(`/showtimes?movie_id=${movie_id}`);

        if (res.data.success) {
          setMovie(res.data.showtimes[0].movie);
          setShowtimes(res.data.showtimes);
        } else {
          console.error("Lỗi khi lấy dữ liệu");
        }
      } catch (error) {
        console.error("Lỗi API:", error);
      }
    };

    fetchData(id);
  }, [id]);

  const onSelectShowTime = (data) => {
    const showTime = `${data.shift.start_time} - ${
      data.shift.end_time
    } Ngày ${dayjs(data.datetime).format("DD/MM/YYYY")}`;

    dispatch(
      selectShowTime({
        showTimeId: data.showtime_id,
        roomId: data.room_id,
        movieName: movie.title,
        showTime,
        showTimePrice: data.value,
      })
    );
    navigate("/check");
  };

  return (
    <div className="main-wrapper">
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

      <div className="movie-details-wrap section-ptb-50 bg-black grid grid-cols-12">
        <div className="container col-span-7">
          <div className="movie-details-video-content-wrap grid grid-cols-12 gap-3 mb-4">
            <div className="video-wrap col-span-4 ">
              {movie && movie.poster_url ? (
                <img
                  className="w-full h-full"
                  src={movie.poster_url}
                  alt={movie.title}
                />
              ) : (
                <p>Loading poster...</p>
              )}
            </div>
            <div className="movie-details-info col-span-8 ">
              <ul>
                <li>
                  <span>Director: </span>
                  {movie ? movie.director : "Loading..."}
                </li>
                <li>
                  <span>Starring: </span>{" "}
                  {movie ? movie.performer : "Loading..."}
                </li>
                <p>{movie ? movie.description : "Loading description..."}</p>
              </ul>

              {/* <div className="">
                <button
                  className="w-40 bg-red-500 text-center  font-medium rounded-md my-3"
                  onClick={toggleVideo}
                >
                  <p className="hover:text-sky-500">Trailer</p>

                  {showVideo && movie && (
                    <div style={modalStyle}>
                      <div style={overlayStyle} onClick={toggleVideo} />
                      <div style={videoContainerStyle}>
                        <button onClick={toggleVideo} style={closeButtonStyle}>
                          X
                        </button>
                        <iframe
                          style={videoStyle}
                          width="100%"
                          height="100%"
                          src={movie.trailer}
                          title="YouTube video player"
                          frameBorder="0"
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                          allowFullScreen
                        ></iframe>
                      </div>
                    </div>
                  )}
                </button>
              </div> */}
            </div>
          </div>
          <hr className="text-gray-400 mb-3" />
          <div className="time">
            <hr className="text-gray-400 my-3" />
            <div className="hour">
              <div className="">
                <ul className="flex justify-between gap-3 item-center">
                  {showtimes.length > 0 ? (
                    showtimes.map((showtime) => (
                      <li
                        key={showtime.showtime_id}
                        className={`border border-red-500 w-44 h-6 text-red-500 text-center rounded ${styles.showTimeItem}`}
                        onClick={() => onSelectShowTime(showtime)}
                      >
                        {showtime.shift.start_time} - {showtime.shift.end_time}
                      </li>
                    ))
                  ) : (
                    <p>Loading hours...</p>
                  )}
                </ul>
              </div>
            </div>
            <hr className="text-gray-400 my-3" />
          </div>
          <div className="like-share-wrap">
            <div className="social-share-wrap">
              <span>Share:</span>
              <div className="social-style-1">
                <a className="facebook" href="#">
                  <i className="zmdi zmdi-facebook"></i>
                </a>
                <a className="pinterest" href="#">
                  <i className="zmdi zmdi-pinterest"></i>
                </a>
                <a className="linkedin" href="#">
                  <i className="zmdi zmdi-linkedin"></i>
                </a>
                <a className="instagram" href="#">
                  <i className="zmdi zmdi-instagram"></i>
                </a>
              </div>
            </div>
            <div className="like-dislike-wrap">
              <button className="like-dislike-style">
                <i className="zmdi zmdi-thumb-up"></i>
              </button>
              <button className="like-dislike-style">
                <i className="zmdi zmdi-thumb-down"></i>
              </button>
            </div>
          </div>
        </div>

        <div className="container col-span-5">
          <p>New Movie</p>
        </div>
      </div>

      <hr />
    </div>
  );
}

export default Detail;
