<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;
    protected $guarded=['id'];
     //relacion 1 a * con productos deail
    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }
    //relacion inversa con product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
