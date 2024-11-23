  import React, { useState, useEffect } from "react";
  import styles from "./Checkout.module.css";
  import { useDispatch, useSelector } from "react-redux";
  import { useNavigate } from "react-router-dom";
  import { fetchMovieError, fetchMovieStart, fetchMovieSuccess } from "../redux/login/movieSlice";
  import { bookTicket } from "../redux/login/tickit";

  const Checkout = () => {
    const [seats, setSeats] = useState([]);
    const [selectedSeats, setSelectedSeats] = useState([]);
    const [totalPrice, setTotalPrice] = useState(0);
    const [showtimeInfo, setShowtimeInfo] = useState(null);
    const [theaterInfo, setTheaterInfo] = useState(null);
    
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const user = useSelector((state) => state.auth.login?.currentUser?.user);
    const { movieData } = useSelector((state) => state.movies);

    // Fetch data
    useEffect(() => {
      const fetchData = async () => {
        try {
          dispatch(fetchMovieStart());

          const [movies, seatData, showtimeData, theaterData] = await Promise.all([
            fetch("http://127.0.0.1:8000/api/movies").then((res) => res.json()),
            fetch("http://127.0.0.1:8000/api/seat").then((res) => res.json()),
            fetch("http://127.0.0.1:8000/api/showtimes").then((res) => res.json()),
            fetch("http://127.0.0.1:8000/api/theaters").then((res) => res.json()),
          ]);

          if (movies.data?.length) {
            dispatch(fetchMovieSuccess({ movie: movies.data }));
          } else {
            dispatch(fetchMovieError("No movie data available"));
          }

          setSeats(seatData.data || []);
          setShowtimeInfo(showtimeData.showtimes?.[0] || null);
          setTheaterInfo(theaterData?.[0]?.theater || null);
        } catch (error) {
          console.error("Error fetching data:", error);
          dispatch(fetchMovieError(error.message));
        }
      };

      fetchData();
    }, [dispatch]);

    // Handle seat selection
    const handleSeatClick = (seatId, seatPrice = 0, status) => {
      if (status !== "available") return;

      setSelectedSeats((prev) =>
        prev.includes(seatId)
          ? prev.filter((seat) => seat !== seatId)
          : [...prev, seatId]
      );

      setTotalPrice((prev) =>
        selectedSeats.includes(seatId) ? prev - seatPrice : prev + seatPrice
      );
    };

    // Handle booking
    const handleBooking = () => {
      if (selectedSeats.length === 0) {
        alert("Please select a seat before booking.");
        return;
      }

      const ticketData = {
        seats: selectedSeats,
        totalPrice,
        movie: movieData?.[0]?.title || "Unknown",
        theater: theaterInfo?.location || "Unknown",
        showtime: movieData?.[0]?.release_date || "Unknown",
      };

      dispatch(bookTicket(ticketData));
      navigate("/bill", { state: ticketData });
    };

    // Count available seats by type
    const countSeatsByType = (typeId) =>
      seats.filter((seat) => seat.type_id === typeId && seat.status === "available").length;

    // Group seats into rows of 8
    const seatRows = [];
    for (let i = 0; i < seats.length; i += 8) {
      seatRows.push(seats.slice(i, i + 8));
    }

    return (
      <div className={styles.container}>
        <div className={styles.grid}>
          {/* Seat Selection Section */}
          <div className={`${styles.leftSection} col-span-9`}>
            <div className="mt-5 flex justify-center">
              <table className={`${styles.table} divide-y divide-gray-200 w-2/3`}>
                <thead>
                  <tr>
                    <th>Regular Seats</th>
                    <th>Selected Seats</th>
                    <th>VIP Seats</th>
                    <th>Booked Seats</th>
                  </tr>
                </thead>
                <tbody className="bg-black divide-y divide-gray-200 text-center">
                  <tr>
                    <td>
                      <button className={styles.ghe}>{countSeatsByType(0)} seats</button>
                    </td>
                    <td>
                      <button className={`${styles.ghe} ${styles.gheDangDat}`}>
                        {selectedSeats.length}
                      </button>
                    </td>
                    <td>
                      <button className={`${styles.ghe} ${styles.gheVip}`}>
                        {countSeatsByType(1)} VIP seats
                      </button>
                    </td>
                    <td>
                      <button className={`${styles.ghe} ${styles.gheDaDat}`}>Booked</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div className="text-center">
              {seatRows.length > 0 ? (
                seatRows.map((row, index) => (
                  <div key={index} className={styles.seatRow}>
                    {row.map((seat) => (
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
                    ))}
                  </div>
                ))
              ) : (
                <p>Loading seat data...</p>
              )}
            </div>
          </div>

          {/* Booking Details Section */}
          <div className={`${styles.rightSection} col-span-3`}>
            <h3 className={styles.totalPrice}>
              Total Price: {totalPrice.toLocaleString()}đ
            </h3>
            <h3 className="text-xl text-white">
              Movie: {movieData?.[0]?.title || "Loading..."}
            </h3>
            <p className="text-white">
              Location: {theaterInfo?.location || "Loading..."}
            </p>
            <p className="text-white">
              Showtime: {movieData?.[0]?.release_date || "Loading..."}{" "}
              {showtimeInfo?.showtime_time || ""}
            </p>
            <hr className="text-white" />
            <div className={styles.flexRow}>
              <span className="text-red-400">Seats:</span>
              {selectedSeats.length > 0 ? selectedSeats.join(", ") : "No seats selected"}
            </div>
            <hr className="text-white" />
            <div className={styles.customerInfo}>
              <p className="text-white">Email: {user?.email || "Not logged in"}</p>
              <p className="text-white">Phone: {user?.phone || "Not logged in"}</p>
            </div>
            <div className="mt-4">
              <button className={styles.submitButton} onClick={handleBooking}>
                Book Tickets
              </button>
            </div>
          </div>
        </div>
      </div>
    );
  };

  export default Checkout;
