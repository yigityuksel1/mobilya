<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = cache()->remember('brands.all', 3600, function () {
            return Brand::orderBy('name')->get();
        });

        return BrandResource::collection($brands);
    }
}