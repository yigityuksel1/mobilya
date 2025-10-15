import { useState } from 'react';
import { api } from '../lib/api';

export default function Login() {
  const [email, setEmail]       = useState('');
  const [password, setPassword] = useState('');
  const [loading, setLoading]   = useState(false);
  const [error, setError]       = useState<string | null>(null);
  const [message, setMessage]   = useState<string | null>(null);

  const handleLogin = async (e: React.FormEvent) => {
    e.preventDefault();
    setError(null);
    setMessage(null);
    setLoading(true);
    try {
      // 1) CSRF cookie al
      await api.get('/sanctum/csrf-cookie');
      // 2) Login isteği
      await api.post('/login', { email, password });
      // 3) Başarılı: artık session cookie set edildi
      setMessage('Giriş başarılı');
      // 4) İstersen kullanıcı bilgisini çek
      // const me = await api.get('/api/user');
      // 5) Yönlendirme yap (örnek)
      // navigate('/dashboard');
    } catch (err: any) {
      setError(err?.response?.data?.message ?? err.message);
    } finally {
      setLoading(false);
    }
  };

  return (
    <form onSubmit={handleLogin} style={{ display: 'grid', gap: 10, maxWidth: 360 }}>
      <input
        type="email"
        placeholder="Email"
        value={email}
        onChange={e => setEmail(e.target.value)}
        required
      />
      <input
        type="password"
        placeholder="Şifre"
        value={password}
        onChange={e => setPassword(e.target.value)}
        required
      />
      <button type="submit" disabled={loading}>
        {loading ? 'Giriş yapılıyor…' : 'Giriş Yap'}
      </button>
      {error && <div style={{ color: 'red' }}>{error}</div>}
      {message && <div style={{ color: 'green' }}>{message}</div>}
    </form>
  );
}
