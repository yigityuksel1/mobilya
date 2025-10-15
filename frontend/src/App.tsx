import { useHealth } from './hooks/useHealth';

export default function App() {
  const { data, isLoading, error } = useHealth();
  if (isLoading) return <div>Yükleniyor...</div>;
  if (error) return <div>Hata: {(error as Error).message}</div>;
  return <pre>{JSON.stringify(data, null, 2)}</pre>;
}

import HealthCheck from './components/HealthCheck';

export default function App() {
  return (
    <div>
      <h1>Frontend</h1>
      <HealthCheck />
    </div>
  );
}
