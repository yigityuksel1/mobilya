// src/pages/Login.tsx
console.log('Login render'); // debug

export default function Login() {
  return (
    <div style={{ padding: 24, fontSize: 24 }}>
      LOGIN PAGE
      <form onSubmit={(e) => { e.preventDefault(); console.log('submit'); }}>
        <button type="submit">Test Submit</button>
      </form>
    </div>
  );
}
