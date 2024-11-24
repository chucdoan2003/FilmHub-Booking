import { configureStore } from "@reduxjs/toolkit";
import authReducer from "./autSlie";  // Adjust path if necessary
import movieReducer from "./movieSlice";  // Correct path to the movie slice
import ticketReducer from "./ticketSlice"

const store = configureStore({
  reducer: {
    auth: authReducer,
    movies: movieReducer,
    ticket: ticketReducer
  },
});

export default store;
