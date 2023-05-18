<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    protected $table = 'product_category';

    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
}
