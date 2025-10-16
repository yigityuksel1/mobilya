export default function Login() {
  const onSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    // Basit bir GET ile Network’te görünürlük
    await fetch('https://dumanmobilya.ddev.site/api/health', { credentials: 'include' });
  };

  return (
    <div style={{ padding: 24 }}>
      <h2>Giriş (test)</h2>
      <form onSubmit={onSubmit}>
        <button type="submit">Health Check</button>
      </form>
    </div>
  );
}
