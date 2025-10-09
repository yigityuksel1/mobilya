<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    public function created(Product $product): void
    {
        cache()->forget('products.index.page1');
    }

    public function updated(Product $product): void
    {
        cache()->forget('products.index.page1');
        // Ürün detay cache'ini de temizle
        cache()->forget("product.detail.{$product->slug}");
    }

    public function deleted(Product $product): void
    {
        cache()->forget('products.index.page1');
        cache()->forget("product.detail.{$product->slug}");
    }
}
