<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    //relacion * a 1 coon unidad de medida
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    //relacion 1 a * producto detalle
    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }
}
