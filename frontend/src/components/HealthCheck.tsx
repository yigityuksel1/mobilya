import { useEffect, useState } from 'react';
import { api } from '../lib/api';

export default function HealthCheck() {
  const [data, setData] = useState<any>(null);
  const [error, setError] = useState<string | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api.get('/api/health') // Backend’te /api/health route’un olmalı
      .then(res => setData(res.data))
      .catch(err => setError(err?.response?.data ?? err.message))
      .finally(() => setLoading(false));
  }, []);

  if (loading) return <div>Checking API…</div>;
  if (error) return <div style={{ color: 'red' }}>Health error: {String(error)}</div>;

  return (
    <pre style={{ background: '#111', color: '#0f0', padding: 12 }}>
      {JSON.stringify(data, null, 2)}
    </pre>
  );
}
