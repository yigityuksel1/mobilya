import { useEffect, useState } from 'react';
import { api } from '../lib/api';

export function useHealth() {
  const [data, setData] = useState<any>(null);
  const [isLoading, setLoading] = useState(true);
  const [error, setError] = useState<Error | null>(null);

  useEffect(() => {
    api.get('/api/health')
      .then(res => setData(res.data))
      .catch(err => setError(new Error(err?.response?.data ?? err.message)))
      .finally(() => setLoading(false));
  }, []);

  return { data, isLoading, error };
}
