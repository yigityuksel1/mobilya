async function handleLogout() {
  try {
    await api.post('/logout');
    // Çıkış sonrası istersen state temizle ve yönlendir:
    // navigate('/login');
  } catch (err) {
    console.error(err);
  }
}
