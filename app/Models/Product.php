<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations; 
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['name','slug','description','image','amount','discount_amount', 'discount', 'is_visible', 'brand_id'];

    public $translatable = ['name','slug','description'];

    protected $casts = [
        'image' => 'array',
    ];

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function category(){
        return $this->belongsToMany(Category::class, 'categories_products');
    }
}