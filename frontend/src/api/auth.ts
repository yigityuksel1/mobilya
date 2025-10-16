import api from './client';

export async function csrf() {
  await api.get('/sanctum/csrf-cookie');
}
export async function login(payload: { email: string; password: string }) {
  await csrf();
  return api.post('/login', payload);
}
export async function logout() {
  return api.post('/logout');
}
export async function me() {
  return api.get('/api/user');
}
