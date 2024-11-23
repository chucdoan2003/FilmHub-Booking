import React, { useState } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import axios from 'axios';  // You can also use fetch if you prefer
import "./Checkout.css";

const Bill = () => {
  const location = useLocation();
  const navigate = useNavigate();

  // Lấy dữ liệu từ location.state (dữ liệu từ Checkout)
  const { seats, totalPrice, movie, showtime, user, theater } = location.state || {};

  // Declare useState hooks at the top level of the component
  const [paymentMethod, setPaymentMethod] = useState(""); // To store selected payment method
  const [loading, setLoading] = useState(false); // To show loading state during payment process

  // Early return for missing data
  if (!seats || !totalPrice || !movie) {
    return (
      <div className="text-center">
        <h1>Không có thông tin vé</h1>
        <button
          onClick={() => navigate("/checkout")}
          className="bg-red-500 px-4 py-2 rounded mt-4"
        >
          Quay lại trang đặt vé
        </button>
      </div>
    );
  }

  const handlePayment = async () => {
    if (!paymentMethod) {
      alert("Vui lòng chọn phương thức thanh toán!");
      return;
    }
  
    setLoading(true); // Show loading state
  
    try {
      console.log("Dữ liệu gửi đi:", {
        movie,
        showtime,
        seats,
        totalPrice,
        theater,
        paymentMethod,
      });
  
      const response = await axios.post("http://127.0.0.1:8000/api/vnpay/payment", {
        movie,
        showtime,
        seats,
        totalPrice,
        theater,
        paymentMethod,
      });
  
      console.log("Phản hồi từ server:", response.data);
  
      if (response.data.success) {
        alert("Thanh toán thành công!");
        navigate("/confirmation"); // Redirect to a confirmation page or success page
      } else {
        alert("Thanh toán thất bại, vui lòng thử lại!");
      }
    } catch (error) {
      console.error("Lỗi thanh toán:", error);
      alert("Có lỗi xảy ra, vui lòng thử lại!");
    } finally {
      setLoading(false); // Hide loading state
    }
  };

  return (
    <div className="contaunerrr">
      <div className="container">
        <div className="grid grid-cols-12">
          {/* Thông tin phim */}
          <div className="col-span-8 m-4">
            <h2 className="text-3xl font-bold ">Thông Tin Phim</h2>
            <h3 className="text-xl my-4 ">Tên Phim: {movie}</h3>
            <p className="my-2 ">Địa điểm: {theater}</p>
            <p className="my-2 ">Ngày chiếu: {showtime}</p>

            {/* Ghế */}
            <div className="flex flex-row">
              <div className="mr-28">
                <p className="">Ghế: </p>
              </div>
              <div className=""> {seats.join(", ")}</div>
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
                  <label htmlFor="credit" className="ml-2">Thẻ tín dụng</label>
                </div>
                <div className="mb-3">
                  <input
                    type="radio"
                    id="bank"
                    name="payment_method"
                    value="bank"
                    onChange={(e) => setPaymentMethod(e.target.value)}
                  />
                  <label htmlFor="bank" className="ml-2">Chuyển khoản</label>
                </div>
                <div className="mb-3">
                  <input
                    type="radio"
                    id="cash"
                    name="payment_method"
                    value="cash"
                    onChange={(e) => setPaymentMethod(e.target.value)}
                  />
                  <label htmlFor="cash" className="ml-2">Tiền mặt</label>
                </div>
              </form>
            </div>

            {/* Chi phí */}
            <div className="my-3">
              <h3 className="text-xl ">Chi phí</h3>
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
