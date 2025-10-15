console.log('Login render edildi');
import { useState } from 'react';
import { api } from '../lib/api';


export default function Login() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [msg, setMsg] = useState<string | null>(null);

  const onSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setMsg(null);
    try {
      await api.get('/sanctum/csrf-cookie');
      await api.post('/login', { email, password });
      setMsg('Giriş başarılı');
    } catch (e: any) {
      setMsg(e?.response?.data?.message ?? e.message);
    }
  };

  return (
    <div style={{ padding: 24 }}>
      <h2>Giriş</h2>
      <form onSubmit={onSubmit} style={{ display: 'grid', gap: 8, maxWidth: 320 }}>
        <input type="email" placeholder="Email" value={email} onChange={e=>setEmail(e.target.value)} required />
        <input type="password" placeholder="Şifre" value={password} onChange={e=>setPassword(e.target.value)} required />
        <button type="submit">Giriş Yap</button>
      </form>
      {msg && <div style={{ marginTop: 8 }}>{msg}</div>}
    </div>
  );
}
