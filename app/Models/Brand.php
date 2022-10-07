<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Translatable\HasTranslations;

class Brand extends Model implements Auditable
{
    use HasFactory;
    use HasTranslations; 
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'slug',
        'website',
        'description'
    ];

    public $translatable = ['name','slug','description'];

    public function product(){
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
