import { loginFailed, loginStart, loginSuccess, registerFailed, registerStart, registerSuccess, logout } from "./autSlie";
import axios from "axios";
export const loginUser = async (user, dispatch, navigate) => {
    dispatch(loginStart());
    try {
        const res = await axios.post("http://127.0.0.1:8000/api/auth/login", user);
        dispatch(loginSuccess(res.data));
        alert("Đăng nhập thành công!");
        navigate("/");
        // Tải lại trang sau khi đăng nhập thành công
        window.location.reload();
        // Sau khi tải lại, chuyển hướng đến trang chủ
    } catch (error) {
        dispatch(loginFailed());
        alert("Đăng nhập thất bại. Vui lòng kiểm tra lại thông tin.");
    }
};
export const registerUser = async (user, dispatch, navigate) => {
    dispatch(registerStart());
    try {
        await axios.post("http://127.0.0.1:8000/api/auth/register", user);
        dispatch(registerSuccess());  
        alert("Đăng ký thành công!");
        window.location.reload() // Hiển thị thông báo khi đăng ký thành công
        navigate("/");
    } catch (err) {
        dispatch(registerFailed());
        alert("Đăng ký thất bại. Vui lòng kiểm tra lại thông tin."); // Thông báo khi đăng ký thất bại
    }
};

export const logoutUser = async (dispatch, navigate) => {
    try {
        await axios.post("http://127.0.0.1:8000/api/auth/logout");
        
        // Xóa thông tin đăng nhập khỏi localStorage
        localStorage.removeItem("authToken");
        localStorage.removeItem("currentUser");

        dispatch(logout());

        alert("Đã đăng xuất thành công!");
        window.location.reload()
        navigate("/");
    } catch (error) {
        console.error("Đăng xuất thất bại", error);
        alert("Đăng xuất thất bại. Vui lòng thử lại.");
    }
};