import React, { useState, useEffect, useMemo } from "react";
import styles from "./Checkout.module.css";
import { useDispatch, useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import { fetchMovieError, fetchMovieStart } from "../redux/login/movieSlice";
import classNames from "classnames";
import { booking } from "../redux/login/ticketSlice";

const Checkout = () => {
  const [seats, setSeats] = useState([]);
  const [selectedSeats, setSelectedSeats] = useState([]);
  const [theaterList, setTheaterList] = useState(null);

  const dispatch = useDispatch();
  const navigate = useNavigate();
  const user = useSelector((state) => state.auth.login?.currentUser?.user);
  const ticket = useSelector((state) => state.ticket);

  // Fetch data
  useEffect(() => {
    const fetchData = async () => {
      try {
        dispatch(fetchMovieStart());

        const [seatData, theaterData] = await Promise.all([
          fetch("http://127.0.0.1:8000/api/seat").then((res) => res.json()),
          fetch("http://127.0.0.1:8000/api/theaters").then((res) => res.json()),
        ]);

        setSeats(
          seatData.data.filter((it) => it.room_id === ticket.roomId) || []
        );
        setTheaterList(theaterData ?? []);
      } catch (error) {
        console.error("Error fetching data:", error);
        dispatch(fetchMovieError(error.message));
      }
    };

    ticket.roomId && fetchData();
  }, [dispatch, ticket.roomId]);

  const location = useMemo(() => {
    if (!ticket.roomId || !theaterList) return;

    const findTheater = theaterList.find((it) =>
      it.theater.rooms.some((x) => x.room_id === ticket.roomId)
    );

    return findTheater.theater.location;
  }, [ticket.roomId, theaterList]);

  const selectedSeatsTxt = useMemo(() => {
    const findSeats = seats.filter((it) => selectedSeats.includes(it.seat_id));

    const txt = findSeats.map((it) => it.seat_number).join(", ");

    return txt;
  }, [selectedSeats, seats]);

  // Handle seat selection
  const handleSeatClick = (seatId, status) => {
    if (status !== "available") return;
    setSelectedSeats((prev) =>
      prev.includes(seatId)
        ? prev.filter((seat) => seat !== seatId)
        : [...prev, seatId]
    );
  };

  // Handle booking
  const handleBooking = () => {
    if (selectedSeats.length === 0) {
      alert("Please select a seat before booking.");
      return;
    }

    dispatch(
      booking({
        location,
        selectedSeats,
        selectedSeatTxt: selectedSeatsTxt,
      })
    );

    navigate("/bill");
  };

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
                    <button className={styles.ghe}></button>
                  </td>
                  <td>
                    <button
                      className={`${styles.ghe} ${styles.gheDangDat}`}
                    ></button>
                  </td>
                  <td>
                    <button
                      className={`${styles.ghe} ${styles.gheVip}`}
                    ></button>
                  </td>
                  <td>
                    <button
                      className={`${styles.ghe} ${styles.gheDaDat}`}
                    ></button>
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
                      className={classNames(styles.ghe, {
                        [styles.gheDaDat]: seat.status === "booked",
                        [styles.gheDangDat]: selectedSeats.includes(
                          seat.seat_id
                        ),
                        [styles.gheVip]: seat.type_id === 1,
                      })}
                      onClick={() => handleSeatClick(seat.seat_id, seat.status)}
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
            Total Price:{" "}
            {(ticket.showTimePrice * selectedSeats.length).toLocaleString()}đ
          </h3>
          <h3 className="text-xl text-white">
            Movie: {ticket.movieName || "Loading..."}
          </h3>
          <p className="text-white">Location: {location || "Loading..."}</p>
          <p className="text-white">
            Showtime: {ticket.showTime || "Loading..."}
          </p>
          <hr className="text-white" />
          <div className={styles.flexRow}>
            <span className="text-red-400 me-1">Seats: </span>
            {selectedSeatsTxt.length > 0
              ? selectedSeatsTxt
              : " No seats selected"}
          </div>
          <hr className="text-white" />
          <div className={styles.customerInfo}>
            <p className="text-white">
              Email: {user?.email || "Not logged in"}
            </p>
            <p className="text-white">
              Phone: {user?.phone || "Not logged in"}
            </p>
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
