import axios from 'axios';

export const api = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL, // .env’deki VITE_API_BASE_URL kullanılacak
  withCredentials: true // Sanctum/cookie kullanıyorsan true yap
});
