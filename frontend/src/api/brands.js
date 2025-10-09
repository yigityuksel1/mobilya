import api from './client';

export const fetchBrands = async () => {
  const res = await api.get('/brands');
  return res.data;
};