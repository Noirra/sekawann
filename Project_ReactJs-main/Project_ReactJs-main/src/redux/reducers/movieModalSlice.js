import { createSlice } from '@reduxjs/toolkit';

export const movieRatingSlice = createSlice({
  name: 'movieRating',
  initialState: {},
  reducers: {
    setRating: (state, action) => {
      const { movieId, rating } = action.payload;
      state[movieId] = rating;
      // Simpan rating ke local storage atau cookie
      // Contoh untuk local storage:
      localStorage.setItem('movieRatings', JSON.stringify(state));
    },
    // loadRating untuk memuat rating dari penyimpanan lokal saat situs web dimuat
    loadRating: (state) => {
      const storedRatings = localStorage.getItem('movieRatings');
      if (storedRatings) {
        Object.assign(state, JSON.parse(storedRatings));
      }
    },
  },
});

const getRatingFromTMDB = async (movieId) => {
  // Implement your logic to fetch rating from TMDB
  // This is just a placeholder, replace it with your actual API call
  const response = await fetch(`https://api.themoviedb.org/3/movie/${movieId}/rating`);
  const data = await response.json();
  return data.rating; // Adjust this based on the actual structure of the TMDB response
};

export const loadRating = (movieId) => async (dispatch) => {
  try {
    // Call the function to get the rating from TMDB
    const rating = await getRatingFromTMDB(movieId);

    // Dispatch the setRating action with the obtained rating
    dispatch(movieRatingSlice.actions.setRating({ movieId, rating }));
  } catch (error) {
    console.error('Error loading rating:', error);
  }
};

export const { hide, showMovie } = createSlice({
  name: 'movieModal',
  initialState: {
    enabled: false,
    movieId: 27205,
    ratings: {},
  },
  reducers: {
    hide: (state) => {
      state.enabled = false;
    },
    showMovie: (state, action) => {
      state.enabled = true;
      state.movieId = action.payload;
    },
    setRating: (state, action) => {
      const { movieId, rating } = action.payload;
      state.ratings[movieId] = rating;
    },
  },
}).actions;

export const isEnabled = (state) => state.movieModal.enabled;
export const selectMovieId = (state) => state.movieModal.movieId;
export const { setRating } = movieRatingSlice.actions;

export default createSlice({
  name: 'movieModal',
  initialState: {
    enabled: false,
    movieId: 27205,
    ratings: {},
  },
  reducers: {
    hide: (state) => {
      state.enabled = false;
    },
    showMovie: (state, action) => {
      state.enabled = true;
      state.movieId = action.payload;
    },
    setRating: (state, action) => {
      const { movieId, rating } = action.payload;
      state.ratings[movieId] = rating;
    },
  },
}).reducer;
