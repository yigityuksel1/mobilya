import './App.css'
import { BrowserRouter, Routes, Route, Link } from 'react-router-dom';
import ProductList from './pages/ProductList';

function Home() {
  return (
    <div className="p-6">
      <h1 className="text-2xl font-semibold">Mobilya Mağazası</h1>
      <p className="text-gray-600 mt-2">Modern, şık ve konforlu mobilyalar.</p>
      <Link to="/products" className="mt-4 inline-block bg-black text-white px-4 py-2 rounded">Ürünler</Link>
    </div>
  );
}

export default function App() {
  return (
    <BrowserRouter>
      <nav className="p-4 border-b">
        <Link to="/" className="font-medium">Anasayfa</Link>
        <Link to="/products" className="ml-4">Ürünler</Link>
      </nav>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/products" element={<ProductList />} />
      </Routes>
    </BrowserRouter>
  );
}