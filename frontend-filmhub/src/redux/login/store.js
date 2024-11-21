import { configureStore } from "@reduxjs/toolkit";
import authReducer from "./autSlie";  // Adjust path if necessary
import movieReducer from "./movieSlice";  // Correct path to the movie slice

const store = configureStore({
  reducer: {
    auth: authReducer,
    movies: movieReducer,
  },
});

export default store;
