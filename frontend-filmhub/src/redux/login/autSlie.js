import { createSlice } from "@reduxjs/toolkit";

// Lấy dữ liệu người dùng từ localStorage (nếu có)
const initialUser = JSON.parse(localStorage.getItem("currentUser")) || null;

const authSlice = createSlice({
  name: "auth",
  initialState: {
    login: {
      currentUser: initialUser,
      isFetching: false,
      error: false,
    },
    register: {
      isFetching: false,
      error: false,
      success: false,
    },
  },
  reducers: {
    loginStart: (state) => {
      state.login.isFetching = true;
    },
    loginSuccess: (state, action) => {
      state.login.isFetching = false;
      state.login.currentUser = action.payload;
      state.login.error = false;
      // Lưu thông tin người dùng vào localStorage khi đăng nhập thành công
      localStorage.setItem("currentUser", JSON.stringify(action.payload));
    },
    loginFailed: (state) => {
      state.login.isFetching = false;
      state.login.error = true;
    },
    registerStart: (state) => {
      state.register.isFetching = true;
    },
    registerSuccess: (state) => {
      state.register.isFetching = false;
      state.register.success = true;
      state.register.error = false;
    },
    registerFailed: (state) => {
      state.register.isFetching = false;
      state.register.error = true;
      state.register.success = false;
    },
    logout: (state) => {
      state.login.currentUser = null;
      // Xóa dữ liệu người dùng khỏi localStorage khi đăng xuất
      localStorage.removeItem("currentUser");
    },
  },
});

export const {
  loginStart,
  loginFailed,
  loginSuccess,
  registerStart,
  registerSuccess,
  registerFailed,
  logout,
} = authSlice.actions;

export default authSlice.reducer;
