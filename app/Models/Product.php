<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'short_description',
        'description',
        'information',
        'price',
        'discount_price',
        'qty',
        'weight',
        'shipping',
        'image_url',
        'status',
        'slug',
        'product_category_id'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id')->withTrashed();
    }
}
