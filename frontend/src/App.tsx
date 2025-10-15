import { Link } from 'react-router-dom';

export default function App() {
  return (
    <div style={{ padding: 16 }}>
      <nav style={{ marginBottom: 16 }}>
        <Link to="/">Anasayfa</Link>{' '}|{' '}
        <Link to="/login">Giriş</Link>
      </nav>
      <h1>Duman Mobilya</h1>
    </div>
  );
}
