<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    protected $fillable = ['name','slug','sku','brand_id','category_id','price','description','is_active','meta_title','meta_description'];

    public function brand() { return $this->belongsTo(Brand::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function variants() { return $this->hasMany(Variant::class); }
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
        $this->addMediaCollection('images');
    }
    public function registerMediaConversions(Media $media = null): void
{
    $this->addMediaConversion('thumb')
        ->width(300)
        ->height(300)
        ->sharpen(10)
        ->nonQueued();
}
}