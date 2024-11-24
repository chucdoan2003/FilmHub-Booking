import React, { useState } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import { useSelector } from "react-redux";
import axios from "axios";
import "./Checkout.css";
import apiClient from "../api/apiClient";

const Bill = () => {
  const location = useLocation();
  const navigate = useNavigate();

  const { seats, totalPrice, movie, showtime, theater } = location.state || {};

  const [paymentMethod, setPaymentMethod] = useState("");
  const [loading, setLoading] = useState(false);

  const user = useSelector((state) => state.auth.login?.currentUser?.user);
  const ticket = useSelector((state) => state.ticket);
  console.log("352 ~ Bill ~ ticket:", ticket);

  const handlePayment = async () => {
    if (!paymentMethod) {
      alert("Vui lòng chọn phương thức thanh toán!");
      return;
    }

    setLoading(true);

    try {
      const payload = {
        user_id: user.user_id,
        showtime_id: ticket.showTimeId,
        total: ticket.totalPrice,
        selected_seats: ticket.selectedSeats.join(","),
        food_id: null,
        drink_id: null,
        combo_id: null,
      };

      const response = await apiClient.post("/vnpay/payment", payload);
      const paymentUrl = response.data.payment_url;

      window.location.href = paymentUrl;
    } catch (error) {
      console.error("Lỗi thanh toán:", error);
      alert("Có lỗi xảy ra, vui lòng thử lại!");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="contaunerrr">
      <div className="container">
        <div className="grid grid-cols-12">
          {/* Thông tin phim */}
          <div className="col-span-8 m-4">
            <h2 className="text-3xl font-bold ">Thông Tin Phim</h2>
            <h3 className="text-xl my-4 ">Tên Phim: {ticket.movieName}</h3>
            <p className="my-2 ">Địa điểm: {theater}</p>
            <p className="my-2 ">Ngày chiếu: {ticket.showTime}</p>

            {/* Ghế */}
            <div className="flex flex-row">
              <div className="mr-28">
                <p className="">Ghế: </p>
              </div>
              <div className=""> {ticket.selectedSeatTxt}</div>
            </div>

            {/* Thông tin khách hàng */}
            <div className="my-5">
              <i className="text-gray-300">Email:</i>
              <p className="">{user?.email || "N/A"}</p>
            </div>
            <div className="my-5">
              <i className="text-gray-300">Phone:</i>
              <p className="">{user?.phone || "N/A"}</p>
            </div>

            {/* Thông tin thanh toán */}
            <div>
              <h2 className="text-3xl font-bold ">Thông Tin Thanh Toán</h2>
              <div className="mt-5">
                <table className="divide-y divide-gray-200 w-2/3">
                  <thead className="bg-gray-50">
                    <tr>
                      <th>Danh mục</th>
                      <th>Số lượng</th>
                      <th>Tổng tiền</th>
                    </tr>
                  </thead>
                  <tbody className="bg-white divide-y divide-gray-200 text-center">
                    <tr>
                      <td>Ghế</td>
                      <td>{ticket.selectedSeats.length}</td>
                      <td>{ticket.totalPrice.toLocaleString()}đ</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          {/* Phương thức thanh toán */}
          <div className="col-span-4 m-4">
            <h2 className="text-3xl font-bold mb-4 ">Phương Thức Thanh Toán</h2>
            <div>
              <form>
                <p className="text-xl mb-3 ">Chọn phương thức thanh toán:</p>
                <div className="mb-3">
                  <input
                    type="radio"
                    id="credit"
                    name="payment_method"
                    value="credit"
                    onChange={(e) => setPaymentMethod(e.target.value)}
                  />
                  <label htmlFor="credit" className="ml-2">
                    Thẻ tín dụng
                  </label>
                </div>
                <div className="mb-3">
                  <input
                    type="radio"
                    id="bank"
                    name="payment_method"
                    value="bank"
                    onChange={(e) => setPaymentMethod(e.target.value)}
                  />
                  <label htmlFor="bank" className="ml-2">
                    Chuyển khoản
                  </label>
                </div>
                <div className="mb-3">
                  <input
                    type="radio"
                    id="cash"
                    name="payment_method"
                    value="cash"
                    onChange={(e) => setPaymentMethod(e.target.value)}
                  />
                  <label htmlFor="cash" className="ml-2">
                    Tiền mặt
                  </label>
                </div>
              </form>
            </div>

            {/* Chi phí */}
            <div className="my-3">
              <h3 className="text-xl ">Chi phí</h3>
              <div className="flex justify-between my-3">
                <p className="me-2">Thanh Toán</p>
                <p>{ticket.totalPrice.toLocaleString()}đ</p>
              </div>
              <div className="flex justify-between my-3">
                <p className="me-2">Phí</p>
                <span>0đ</span>
              </div>
              <div className="flex justify-between my-3">
                <p className="me-2">Tổng tiền</p>
                <span>{ticket.totalPrice.toLocaleString()}đ</span>
              </div>
            </div>

            {/* Nút thanh toán */}
            <div className="mb-0 h-full flex flex-col items-center">
              <button
                className="bg-red-400 w-full text-center py-3 font-bold text-2xl cursor-pointer"
                onClick={handlePayment} // Handle the payment on button click
                disabled={loading} // Disable button while loading
              >
                {loading ? "Đang xử lý..." : "Thanh Toán"}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Bill;
