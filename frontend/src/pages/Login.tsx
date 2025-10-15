export default function Login() {
  return (
    <div style={{ padding: 24 }}>
      <h2>Giriş</h2>
      <form style={{ display: 'grid', gap: 8, maxWidth: 320 }}>
        <input placeholder="Email" />
        <input placeholder="Şifre" type="password" />
        <button type="submit">Giriş Yap</button>
      </form>
    </div>
  );
}
