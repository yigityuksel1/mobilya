import api from './client';

export const fetchProducts = async (params = {}) => {
  const res = await api.get('/products', { params });
  return res.data;
};

export const fetchProductDetail = async (slug) => {
  const res = await api.get(`/products/${slug}`);
  return res.data;
};