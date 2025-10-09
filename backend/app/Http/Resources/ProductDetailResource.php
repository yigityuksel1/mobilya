<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $cover  = method_exists($this, 'getFirstMedia') ? $this->getFirstMedia('cover') : null;
        $images = method_exists($this, 'getMedia') ? $this->getMedia('images') : collect();

        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'sku'         => $this->sku,
            'price'       => $this->price,
            'description' => $this->description,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'is_active'   => (bool) $this->is_active,

            'brand'       => $this->whenLoaded('brand', fn () => [
                'name' => $this->brand->name,
                'slug' => $this->brand->slug,
            ]),
            'category'    => $this->whenLoaded('category', fn () => [
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ]),

            'variants'    => VariantResource::collection($this->whenLoaded('variants')),

            'cover'       => $cover ? [
                'url'   => $cover->getUrl(),
                'thumb' => $cover->hasGeneratedConversion('thumb') ? $cover->getUrl('thumb') : $cover->getUrl(),
            ] : null,

            'images'      => $images->map(fn ($m) => [
                'url'   => $m->getUrl(),
                'thumb' => $m->hasGeneratedConversion('thumb') ? $m->getUrl('thumb') : $m->getUrl(),
            ])->values(),

            'created_at'  => $this->created_at?->toISOString(),
            'updated_at'  => $this->updated_at?->toISOString(),
        ];
    }
}