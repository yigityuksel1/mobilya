<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Modeller
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

// Observers
use App\Observers\BrandObserver;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Brand::observe(BrandObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}