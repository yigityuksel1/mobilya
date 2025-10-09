<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDetailResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Filtre parametrelerini topla
        $search   = (string) $request->query('search', '');
        $category = (string) $request->query('category', '');
        $brand    = (string) $request->query('brand', '');
        $page     = (int) $request->query('page', 1);

        // Sadece filtresiz ve page=1 ise cache'le (60 saniye)
        if ($search === '' && $category === '' && $brand === '' && $page === 1) {
            $payload = cache()->remember('products.index.page1', 60, function () {
                $query = Product::query()
                    ->with(['brand:id,name,slug', 'category:id,name,slug'])
                    ->where('is_active', true)
                    ->orderByDesc('created_at');

                $products = $query->paginate(12);

                return ProductResource::collection($products)
                    ->additional([
                        'meta' => [
                            'filters' => [
                                'search'   => null,
                                'category' => null,
                                'brand'    => null,
                            ],
                        ],
                    ])
                    ->response()
                    ->getData(true);
            });

            return response()->json($payload);
        }

        // Normal akış (filtreli/pagineli)
        $query = Product::query()
            ->with(['brand:id,name,slug', 'category:id,name,slug'])
            ->where('is_active', true);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category !== '') {
            $query->whereHas('category', fn ($q) => $q->where('slug', $category));
        }

        if ($brand !== '') {
            $query->whereHas('brand', fn ($q) => $q->where('slug', $brand));
        }

        $products = $query->orderByDesc('created_at')->paginate(12);

        return ProductResource::collection($products)
            ->additional([
                'meta' => [
                    'filters' => [
                        'search'   => $search ?: null,
                        'category' => $category ?: null,
                        'brand'    => $brand ?: null,
                    ],
                ],
            ]);
    }

    public function show(string $slug)
    {
        // Ürün detayını cache'le (5 dakika)
        $cacheKey = "product.detail.{$slug}";

        $product = cache()->remember($cacheKey, 300, function () use ($slug) {
            return Product::with([
                    'brand:id,name,slug',
                    'category:id,name,slug',
                    'variants:id,product_id,name,sku,price,stock',
                ])
                ->where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        });

        return new ProductDetailResource($product);
    }
}