import axios from 'axios';

export const api = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL, // .env: https://mobilya.ddev.site
  withCredentials: true, // Sanctum kullanıyorsanız gerekli; JWT’de açık kalsa da sorun olmaz
});

api.interceptors.request.use((config) => {
  const token = localStorage.getItem('access_token'); // JWT kullanıyorsanız
  if (token) {
    config.headers = config.headers ?? {};
    (config.headers as any).Authorization = `Bearer ${token}`;
  }
  return config;
});
