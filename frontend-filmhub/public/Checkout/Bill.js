

import React from "react";
import { useLocation, useNavigate } from "react-router-dom";
import "./Checkout.css";

const Bill = () => {
  const location = useLocation();
  const navigate = useNavigate();

  // Lấy dữ liệu từ location.state (dữ liệu từ Checkout)
  const { seats, totalPrice, movie, showtime, user ,theater , selectedSeats} = location.state || {};
  if (!seats || !totalPrice || !movie) {
    return (
      <div className="text-center text-white">
        <h1>Không có thông tin vé</h1>
        <button
          onClick={() => navigate("/checkout")}
          className="bg-red-500 text-white px-4 py-2 rounded mt-4"
        >
          Quay lại trang đặt vé
        </button>
      </div>
    );
  }

  // Kiểm tra nếu thiếu dữ liệu, quay lại trang trước
 
  return (
    <div className="contaunerrr">
    <div className="container">
      <div className="grid grid-cols-12">
        {/* Thông tin phim */}
        <div className="col-span-8 m-4">
          <h2 className="text-3xl font-bold text-white">Thông Tin Phim </h2>
          <h3 className="text-xl my-4 text-white">Tên Phim: {movie}</h3>
          <p className="my-2 text-white">Địa điểm: {theater}</p>
          <p className="my-2 text-white">Ngày chiếu: {showtime}</p>

          {/* Ghế */}
          <div className="flex flex-row">
            <div className="mr-28">
              <p className="text-white">Ghế: </p>
            </div>
            <div className="text-white"> {seats.join(", ")}</div>
          </div>

          {/* Thông tin khách hàng */}
          <div className="my-5">
            <i className="text-gray-300">Email:</i>
            <p className="text-white">{user?.email || "N/A"}</p>
          </div>
          <div className="my-5">
            <i className="text-gray-300">Phone:</i>
            <p className="text-white">{user?.phone || "N/A"}</p>
          </div>

          {/* Thông tin thanh toán */}
          <div>
            <h2 className="text-3xl font-bold text-white">Thông Tin Thanh Toán</h2>
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
                    <td>{seats.length}</td>
                    <td>{totalPrice.toLocaleString()}đ</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        {/* Phương thức thanh toán */}
        <div className="col-span-4 m-4">
          <h2 className="text-3xl font-bold mb-4 text-white">Phương Thức Thanh Toán</h2>
          <div>
            <form>
              <p className="text-xl mb-3 text-white">Chọn phương thức thanh toán:</p>
              <div className="mb-3">
                <input type="radio" id="credit" name="payment_method" value="credit" />
                <label htmlFor="credit" className="text-white ml-2">Thẻ tín dụng</label>
              </div>
              <div className="mb-3">
                <input type="radio" id="bank" name="payment_method" value="bank" />
                <label htmlFor="bank" className="text-white ml-2">Chuyển khoản</label>
              </div>
              <div className="mb-3">
                <input type="radio" id="cash" name="payment_method" value="cash" />
                <label htmlFor="cash" className="text-white ml-2">Tiền mặt</label>
              </div>
            </form>
          </div>

          {/* Chi phí */}
          <div className="my-3">
            <h3 className="text-xl text-white">Chi phí</h3>
            <div className="flex justify-between my-3">
              <p>Thanh Toán</p>
              <span>{totalPrice.toLocaleString()}đ</span>
            </div>
            <div className="flex justify-between my-3">
              <p>Phí</p>
              <span>0đ</span>
            </div>
            <div className="flex justify-between my-3">
              <p>Tổng tiền</p>
              <span>{totalPrice.toLocaleString()}đ</span>
            </div>
          </div>

          {/* Nút thanh toán */}
          <div className="mb-0 h-full flex flex-col items-center">
            <button
              className="bg-red-400 text-white w-full text-center py-3 font-bold text-2xl cursor-pointer"
              onClick={() => alert("Thanh toán thành công!")}>
              Thanh Toán
            </button>
          </div>
        </div>
      </div>
    </div>
    </div>
  );
};

export default Bill;
