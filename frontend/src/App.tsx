import { Link } from 'react-router-dom';
import { useHealth } from './hooks/useHealth';

export default function App() {
  const { data, isLoading, error } = useHealth();

  return (
    <div style={{ padding: 16 }}>
      <nav style={{ marginBottom: 16 }}>
        <Link to="/">Anasayfa</Link>{' '}|{' '}
        <Link to="/login">Giriş</Link>
      </nav>

      <h1>Duman Mobilya</h1>

      {isLoading && <div>Yükleniyor...</div>}
      {error && <div style={{ color: 'red' }}>Hata: {(error as Error).message}</div>}
      {data && (
        <pre style={{ textAlign: 'left' }}>
          {JSON.stringify(data, null, 2)}
        </pre>
      )}
    </div>
  );
}
