import { createSlice } from "@reduxjs/toolkit";

const ticketSlice = createSlice({
  name: "ticket",
  initialState: {
    showTimeId: null,
    total: 0,
    selectedSeats: [],
    foodId: null,
    drinkId: null,
    comboId: null,
    roomId: null,
    movieName: null,
    showTime: null,
    showTimePrice: 0,
    location: null,
    totalPrice: 0,
    selectedSeatTxt: null,
    bookedSeats: [],
    rate: {
      normal: null,
      vip: null,
    },
  },
  reducers: {
    selectShowTime: (state, { payload }) => {
      state.showTimeId = payload.showTimeId;
      state.roomId = payload.roomId;
      state.movieName = payload.movieName;
      state.showTime = payload.showTime;
      state.showTimePrice = payload.showTimePrice;
      state.bookedSeats = payload.bookedSeats;
      state.rate = payload.rate;
    },

    booking: (state, { payload }) => {
      state.location = payload.location;
      state.selectedSeats = payload.selectedSeats;
      state.totalPrice = payload.totalPrice;
      state.selectedSeatTxt = payload.selectedSeatTxt;
    },
  },
});

export const { selectShowTime, booking } = ticketSlice.actions;
export default ticketSlice.reducer;
