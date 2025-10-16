import { useEffect, useState } from 'react';
import { me } from '../api/auth';

export default function Me() {
  const [data, setData] = useState<any>(null);
  const [err, setErr] = useState<string | null>(null);

  useEffect(() => {
    me().then(r => setData(r.data)).catch(e => setErr(e?.response?.data?.message ?? e.message));
  }, []);

  if (err) return <div style={{ color: 'red' }}>{err}</div>;
  return <pre>{JSON.stringify(data, null, 2)}</pre>;
}
