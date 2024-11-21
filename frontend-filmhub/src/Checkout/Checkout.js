import React, { useState, useEffect } from "react";
import styles from "./Checkout.module.css";
import { useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";

const Checkout = () => {
  const [seats, setSeats] = useState([]);
  const [selectedSeats, setSelectedSeats] = useState([]);
  const [totalPrice, setTotalPrice] = useState(0);
  const [showtimeInfo, setShowtimeInfo] = useState(null);
  const user = useSelector((state) => state.auth.login?.currentUser?.user);
  const navigate = useNavigate();

  // Fetch seats and showtimes data
  useEffect(() => {
    // Fetch seats data
    fetch("http://127.0.0.1:8000/api/seat")
      .then((response) => response.json())
      .then((data) => {
        if (data.data) {
          setSeats(data.data);
        } else {
          console.error("Invalid seat data:", data);
        }
      })
      .catch((err) => {
        console.error("Error fetching seat data:", err);
        alert("Không thể tải dữ liệu ghế. Vui lòng thử lại sau.");
      });

    // Fetch showtimes data
    fetch("http://127.0.0.1:8000/api/showtimes")
    .then((response) => response.json())
    .then((data) => {
      if (data && data.showtimes) {
        setShowtimeInfo(data.showtimes[0]); // Giả sử bạn muốn lấy suất chiếu đầu tiên trong mảng
       // Log giá trị suất chiếu
      } else {
        console.error("Invalid showtime data:", data);
      }
    })
    .catch((err) => {
      console.error("Error fetching showtime data:", err);
      alert("Không thể tải dữ liệu suất chiếu. Vui lòng thử lại sau.");
    });
  }, []);

  // Kiểm tra dữ liệu `movie_name`

  // Handle seat selection
  const handleSeatClick = (seatId, seatPrice, status) => {
    console.log("Seat ID:", seatId);
    console.log("Seat Price:", seatPrice);
    console.log("Seat Status:", status);
    if (status !== "available") return;

    const validPrice = seatPrice && !isNaN(seatPrice) ? seatPrice : 0;

    setSelectedSeats((prevSelectedSeats) => {
      if (prevSelectedSeats.includes(seatId)) {
        setTotalPrice((prevPrice) => prevPrice - validPrice);
        return prevSelectedSeats.filter((seat) => seat !== seatId);
      } else {
        setTotalPrice((prevPrice) => prevPrice + validPrice);
        return [...prevSelectedSeats, seatId];
      }
    });
  };

  // Handle booking
  const handleBooking = () => {
    if (selectedSeats.length === 0) {
      alert("Vui lòng chọn ghế trước khi đặt vé.");
      return;
    }

    // Navigate to bill page with selected data
    navigate("/bill", {
      state: {
        selectedSeats,
        totalPrice,
        user,
        showtime: showtimeInfo,
      },
    });
  };

  // Count available seats by type (Regular or VIP)
  const countSeatsByType = (typeId) =>
    seats.filter((seat) => seat.type_id === typeId && seat.status === "available").length;

  return (
    <div className={styles.container}>
      <div className={styles.grid}>
        {/* Seat display section */}
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
                    ${selectedSeats.includes(seat.seat_id) ? styles.gheDangDat : ""} 
                    ${seat.status !== "available" ? styles.gheDaDat : ""} 
                    ${seat.type_id === 1 ? styles.gheVip : styles.gheRegular}`}
                  onClick={() => handleSeatClick(seat.seat_id, showtimeInfo?.value, seat.status)}
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

        {/* Booking and information section */}
        <div className={`${styles.rightSection} col-span-3`}>
          <h3 className={styles.totalPrice}>
            Tổng tiền: {totalPrice.toLocaleString()}đ
          </h3>
          <h3 className="text-xl text-white">
            Phim: {showtimeInfo?.value || "Đang tải..."}
          </h3>
          
          <p className="text-white">
            Địa điểm: {showtimeInfo?.cinema_name || "Đang tải..."}
          </p>
          <p className="text-white">
            Ngày chiếu: {showtimeInfo?.created_at || "Đang tải..."} -{" "}
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
