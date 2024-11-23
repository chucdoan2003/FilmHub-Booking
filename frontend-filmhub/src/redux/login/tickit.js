// ticketSlice.js
import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  bookedTickets: [], // Lưu danh sách vé đã đặt
};

const ticketSlice = createSlice({
  name: "tickets",
  initialState,
  reducers: {
    bookTicket: (state, action) => {
      state.bookedTickets.push(action.payload); // Thêm vé mới vào danh sách
    },
  },
});

export const { bookTicket } = ticketSlice.actions;
export default ticketSlice.reducer;
