import axios from "axios";

const instance = axios.create({
    baseURL: "https://api.themoviedb.org/3",
    headers: {
        "Content-Type": "application/json"
    },
});

instance.interceptors.request.use(
    (config) => {
        // TODO: Utilize environment variables. Using throwaway account for now.
        config.headers["Authorization"] = `Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiYjI2OWZhMWRiYzk1ZDY3YzJkNDJkMGVlNjY0MmI5YyIsInN1YiI6IjY1NjllMDYwY2Y0OGExMDEwMTllOWM2YSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.rbybJSdUwYrKpY98jHE_gZDNMk0NgjzBjFMeLgjcEqI`;
        return config;
    },
    (error) => {
        console.log("REQUEST ERROR")
        return Promise.reject(error);
    }
)

export default instance;