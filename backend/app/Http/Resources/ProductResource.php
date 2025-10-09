<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Cover thumb
        $cover = method_exists($this, 'getFirstMedia') ? $this->getFirstMedia('cover') : null;

        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'slug'      => $this->slug,
            'sku'       => $this->sku,
            'price'     => $this->price,
            'is_active' => (bool) $this->is_active,

            'brand'     => $this->whenLoaded('brand', fn () => [
                'name' => $this->brand->name,
                'slug' => $this->brand->slug,
            ]),
            'category'  => $this->whenLoaded('category', fn () => [
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ]),

            'cover_url' => $cover ? ($cover->hasGeneratedConversion('thumb') ? $cover->getUrl('thumb') : $cover->getUrl()) : null,

            'created_at'=> $this->created_at?->toISOString(),
        ];
    }
}