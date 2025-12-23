<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'produk_name',
        'produk_code',
        'price',
        'tanggal_masuk',
        'quantity',
        'product_description_short',
        'product_description_long',
        'tag_id',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'product_tags','product_id','tag_id');
    }
}
