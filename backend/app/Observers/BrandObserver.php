<?php

namespace App\Observers;

use App\Models\Brand;

class BrandObserver
{
    public function created(Brand $brand): void
    {
        cache()->forget('brands.all');
    }

    public function updated(Brand $brand): void
    {
        cache()->forget('brands.all');
    }

    public function deleted(Brand $brand): void
    {
        cache()->forget('brands.all');
    }
}
