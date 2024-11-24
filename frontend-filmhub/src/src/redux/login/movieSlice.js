import { createSlice } from "@reduxjs/toolkit";

// Initial state for the movies
const initialMovieState = {
  movieData: null,  // Holds movie data (could be an array or object depending on API)
  cinemaData: [],   // Holds data about cinemas showing the movie
  loading: false,   // Whether data is being fetched
  error: null,      // Stores error information in case the fetch fails
};
// Create a slice for managing movie-related data
const movieSlice = createSlice({
  name: "movies",  // Name of the slice, used to identify the part of the store
  initialState: initialMovieState,  // Default state
  reducers: {
    // Action to start fetching movie data
    fetchMovieStart: (state) => {
      state.loading = true;
    },

    // Action when movie data is successfully fetched
    fetchMovieSuccess: (state, action) => {
      state.movieData = action.payload.movie;  // Save movie data in the state
      state.cinemaData = action.payload.cinemas;  // Save cinema data in the state
      state.loading = false;  // Set loading to false after data is fetched
    },

    // Action when there is an error fetching movie data
    fetchMovieError: (state, action) => {
      state.error = action.payload;  // Save the error message
      state.loading = false;  // Set loading to false after error
    },
  },
});

// Export the actions for fetching movie data
export const {
  fetchMovieStart,
  fetchMovieSuccess,
  fetchMovieError,
} = movieSlice.actions;

// Export the reducer to be used in the store
export default movieSlice.reducer;
