<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = cache()->remember('categories.tree', 3600, function () {
            return Category::with(['children' => function ($q) {
                $q->with('children');
            }])
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
        });

        return CategoryResource::collection($categories);
    }
}