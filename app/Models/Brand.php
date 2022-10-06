<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Brand extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'slug',
        'website',
        'description'
    ];

    public function product(){
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
