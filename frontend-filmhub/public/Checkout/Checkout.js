import React, { useState, useEffect } from "react";
import styles from "./Checkout.module.css";
import { useDispatch, useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import { fetchMovieError, fetchMovieStart, fetchMovieSuccess } from "../../redux/login/movieSlice";
import { bookTicket } from "../../redux/login/tickit";

const Checkout = () => {
  const [seats, setSeats] = useState([]);
  const [selectedSeats, setSelectedSeats] = useState([]);
  const [totalPrice, setTotalPrice] = useState(0);
  const [showtimeInfo, setShowtimeInfo] = useState(null);
  const [showdiadiem, setDiadiem] = useState(null);
  const user = useSelector((state) => state.auth.login?.currentUser?.user);
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const { movieData } = useSelector((state) => state.movies);

  // Fetch data
  useEffect(() => {
    // Fetch movies
    dispatch(fetchMovieStart());
    fetch("http://127.0.0.1:8000/api/movies")
      .then((response) => response.json())
      .then((data) => {
        if (data.data && data.data.length > 0) {
          dispatch(fetchMovieSuccess({ movie: data.data }));
        } else {
          dispatch(fetchMovieError("Dữ liệu phim không đầy đủ"));
        }
      })
      .catch((err) => dispatch(fetchMovieError(err.message)));

    // Fetch seats
    fetch("http://127.0.0.1:8000/api/seat")
      .then((response) => response.json())
      .then((data) => setSeats(data.data || []))
      .catch((err) => console.error("Error fetching seat data:", err));

    // Fetch showtimes
    fetch("http://127.0.0.1:8000/api/showtimes")
      .then((response) => response.json())
      .then((data) => setShowtimeInfo(data.showtimes?.[0] || null))
      .catch((err) => console.error("Error fetching showtime data:", err));

      fetch("http://127.0.0.1:8000/api/theaters")
  .then((response) => response.json())
  .then((data) => {
    // Kiểm tra mảng trả về và set giá trị đúng
    if (data.length > 0) {
      setDiadiem(data[0].theater); // Lấy theater của phần tử đầu tiên
    } else {
      setDiadiem(null);
    }
  })
  .catch((err) => console.error("Error fetching theater data:", err));
  }, [dispatch]);

  // Handle seat selection
  const handleSeatClick = (seatId, seatPrice, status) => {
    if (status !== "available") return;

    const validPrice = seatPrice && !isNaN(seatPrice) ? seatPrice : 0;

    setSelectedSeats((prev) =>
      prev.includes(seatId)
        ? prev.filter((seat) => seat !== seatId)
        : [...prev, seatId]
    );
    setTotalPrice((prev) =>
      selectedSeats.includes(seatId) ? prev - validPrice : prev + validPrice
    );
  };

  // Navigate to bill page
  
   
  
  const handleBooking = () => {
    if (selectedSeats.length === 0) {
      alert("Vui lòng chọn ghế trước khi đặt vé.");
      return;
    }
  
    // Dữ liệu vé
    const ticketData = {
    
      seats: selectedSeats,
      totalPrice,
      movie: movieData?.[0]?.title || "Không xác định",
      theater: showdiadiem?.location,
      showtime: showtimeInfo?.value || "Không xác định",
    };
  
    // Lưu vé vào Redux store
    dispatch(bookTicket(ticketData));
  
    // Chuyển hướng sang trang hóa đơn
    navigate("/bill", { state: ticketData });
  };
  // Count available seats by type
  const countSeatsByType = (typeId) =>
    seats.filter((seat) => seat.type_id === typeId && seat.status === "available").length;

  return (
    <div className={styles.container}>
      <div className={styles.grid}>
        {/* Seat Selection Section */}
        <div className={`${styles.leftSection} col-span-9`}>
          <div className="mt-5 flex justify-center">
            <table className={`${styles.table} divide-y divide-gray-200 w-2/3`}>
              <thead>
                <tr>
                  <th>Ghế Thường</th>
                  <th>Ghế Đang Đặt</th>
                  <th>Ghế VIP</th>
                  <th>Ghế Đã Đặt</th>
                </tr>
              </thead>
              <tbody className="bg-black divide-y divide-gray-200 text-center">
                <tr>
                  <td>
                    <button className={styles.ghe}>{countSeatsByType(0)} ghế</button>
                  </td>
                  <td>
                    <button className={`${styles.ghe} ${styles.gheDangDat}`}>
                      {selectedSeats.length}
                    </button>
                  </td>
                  <td>
                    <button className={`${styles.ghe} ${styles.gheVip}`}>
                      {countSeatsByType(1)} ghế VIP
                    </button>
                  </td>
                  <td>
                    <button className={`${styles.ghe} ${styles.gheDaDat}`}>Đã đặt</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div className="text-center">
            {seats.length > 0 ? (
              seats.map((seat) => (
                <button
                  key={seat.seat_id}
                  className={`${styles.ghe} 
                    ${selectedSeats.includes(seat.seat_number) ? styles.gheDangDat : ""} 
                    ${seat.status !== "available" ? styles.gheDaDat : ""} 
                    ${seat.type_id === 1 ? styles.gheVip : styles.gheRegular}`}
                  onClick={() =>
                    handleSeatClick(seat.seat_number, showtimeInfo?.value, seat.status)
                  }
                  disabled={seat.status !== "available"}
                >
                  {seat.seat_number}
                </button>
              ))
            ) : (
              <p>Đang tải dữ liệu ghế...</p>
            )}
          </div>
        </div>

        {/* Booking Details Section */}
        <div className={`${styles.rightSection} col-span-3`}>
          <h3 className={styles.totalPrice}>
            Tổng tiền: {totalPrice.toLocaleString()}đ
          </h3>
          <h3 className="text-xl text-white">
            Phim: {movieData?.[0]?.title || "Đang tải..."}
          </h3>
          <p className="text-white">
            Địa điểm: {showdiadiem?.location || "Đang tải..."}
          </p>
          <p className="text-white">
            Ngày chiếu: {movieData?.[0]?.release_date || "Đang tải..."}{" "}
            {showtimeInfo?.showtime_time || ""}
          </p>
          <hr className="text-white" />
          <div className={styles.flexRow}>
            <span className="text-red-400">Ghế:</span>
            {selectedSeats.length > 0 ? selectedSeats.join(", ") : "Chưa chọn ghế nào"}
          </div>
          <hr className="text-white" />
          <div className={styles.customerInfo}>
            <p className="text-white">Email: {user?.email || "Chưa đăng nhập"}</p>
            <p className="text-white">Phone: {user?.phone || "Chưa đăng nhập"}</p>
          </div>
          <div className="mt-4">
            <button className={styles.submitButton} onClick={handleBooking}>
              ĐẶT VÉ
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Checkout;
