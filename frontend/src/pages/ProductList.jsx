import { useQuery } from '@tanstack/react-query';
import { fetchProducts } from '../api/products';

function Loader() { return <div className="py-10 text-center text-gray-500">Yükleniyor...</div>; }
function ErrorState({ message = 'Bir hata oluştu.' }) { return <div className="py-10 text-center text-red-600">{message}</div>; }

export default function ProductList() {
    const { data, isLoading, isError } = useQuery({
        queryKey: ['products'],
        queryFn: () => fetchProducts(),
        staleTime: 30_000,
      });
      
      if (isLoading) return <Loader />;
      if (isError) return <ErrorState />;
      
      const products = Array.isArray(data?.data) ? data.data : [];
  return (
    <div className="grid gap-4 p-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      {products.map(p => (
        <div key={p.id} className="rounded border bg-white">
          <img src={p.cover_url || 'https://via.placeholder.com/400x300?text=No+Image'} alt={p.name} className="h-48 w-full object-cover rounded-t" />
          <div className="p-3">
            <div className="font-medium">{p.name}</div>
            <div className="text-sm text-gray-500">{p.brand?.name || 'Marka yok'}</div>
          </div>
        </div>
      ))}
      {products.length === 0 && (
        <div className="col-span-full text-center text-gray-500">Ürün bulunamadı.</div>
      )}
    </div>
  );
}