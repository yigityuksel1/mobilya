import { useState } from 'react';
import { login, me } from '../api/auth';

export default function Login() {
  const [email, setEmail] = useState('test@example.com');
  const [password, setPassword] = useState('password');
  const [msg, setMsg] = useState<string | null>(null);

  const onSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setMsg(null);
    try {
      await login({ email, password });
      const r = await me();
      setMsg(`Giriş başarılı: ${r.data?.email ?? 'ok'}`);
    } catch (err: any) {
      setMsg(err?.response?.data?.message ?? err.message);
    }
  };

  return (
    <div style={{ padding: 24, maxWidth: 360, margin: '0 auto' }}>
      <h2>Giriş</h2>
      <form onSubmit={onSubmit} style={{ display: 'grid', gap: 8 }}>
        <input type="email" value={email} onChange={e=>setEmail(e.target.value)} placeholder="Email" required />
        <input type="password" value={password} onChange={e=>setPassword(e.target.value)} placeholder="Şifre" required />
        <button type="submit">Giriş Yap</button>
      </form>
      {msg && <div style={{ marginTop: 8 }}>{msg}</div>}
    </div>
  );
}
