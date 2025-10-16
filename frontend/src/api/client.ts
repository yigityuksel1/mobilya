import axios from 'axios';
const api = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL, // .env: VITE_API_BASE_URL=https://dumanmobilya.ddev.site
  withCredentials: true
});
export default api;
