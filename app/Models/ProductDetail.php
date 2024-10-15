<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    //relacion de 1 a * inversa con producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    //relacion de 1 a * inversa con material
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
