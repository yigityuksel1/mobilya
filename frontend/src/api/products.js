import api from './client';

export const fetchProducts = async (params = {}) => {
  const res = await api.get('/api/products', { params }); // DÜZELTİLDİ
  return res.data;
};

export const fetchProductDetail = async (slug) => {
  const res = await api.get(`/api/products/${slug}`); // DÜZELTİLDİ
  return res.data;
};
