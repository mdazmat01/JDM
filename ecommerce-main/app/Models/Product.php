<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function productImage(){
        return $this->hasMany(ProductImage::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'description',
        'price',
        'stock',
        'color',
        'status'
    ];
}
