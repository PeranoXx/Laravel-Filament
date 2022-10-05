<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','slug','description','image','amount','discount_amount', 'discount', 'is_visible', 'brand_id'];

    public $translatable = ['name','slug','description','image','amount','discount_amount', 'discount'];
    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function category(){
        return $this->belongsToMany(Category::class, 'categories_products');
    }
}