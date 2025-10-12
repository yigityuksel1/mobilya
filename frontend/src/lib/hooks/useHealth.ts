import { useQuery } from '@tanstack/react-query';
import { api } from '@/lib/apiClient';

export function useHealth() {
  return useQuery({
    queryKey: ['health'],
    queryFn: async () => (await api.get('/api/health')).data, // Tam URL: https://mobilya.ddev.site/api/health
  });
}
