import api from './client';

export const fetchCategories = async () => {
  const res = await api.get('/categories');
  return res.data;
};