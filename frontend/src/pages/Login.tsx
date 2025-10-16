import { useState } from 'react';
import { login, me } from '../api/auth'; // eğer yoksa şimdilik kaldırabilirsin

export default function Login() {
  const [email, setEmail] = useState('test@example.com');
  const [password, setPassword] = useState('password');

  const onSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    // Geçici: sadece bir GET isteği atıp Network’te görmeyi sağlayalım
    await fetch('https://dumanmobilya.ddev.site/api/health', { credentials: 'include' });
    // Sonraki adımda gerçek login çağrılarını tekrar ekleyeceğiz
  };

  return (
    <div style={{ padding: 24 }}>
      <h2>Giriş</h2>
      <form onSubmit={onSubmit} style={{ display: 'grid', gap: 8, maxWidth: 320 }}>
        <input type="email" placeholder="Email" value={email} onChange={e=>setEmail(e.target.value)} required />
        <input type="password" placeholder="Şifre" value={password} onChange={e=>setPassword(e.target.value)} required />
        <button type="submit">Giriş Yap</button>
      </form>
    </div>
  );
}
