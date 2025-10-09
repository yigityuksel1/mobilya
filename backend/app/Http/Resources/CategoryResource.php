<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'parent_id'   => $this->parent_id,
            // Hiyerarşi gerekiyorsa children ilişkisini isteğe bağlı dahil et
            'children'    => CategoryResource::collection($this->whenLoaded('children')),
        ];
    }
}