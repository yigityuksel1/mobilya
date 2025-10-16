import React from 'react';
import ReactDOM from 'react-dom/client';

console.log('MAIN TSX LOADED');

function Marker() {
  return (
    <div style={{ padding: 24, background: '#222', color: '#0ff', fontSize: 28 }}>
      MAIN.TSX WORKS
    </div>
  );
}

ReactDOM.createRoot(document.getElementById('root')!).render(
  <React.StrictMode>
    <Marker />
  </React.StrictMode>
);
