<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','description','image','amount','discount_amount', 'discount', 'is_visible', 'brand_id'];

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function category(){
        return $this->belongsToMany(Category::class, 'categories_products');
    }
}