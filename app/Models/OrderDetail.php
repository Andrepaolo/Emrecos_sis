<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    //relacion de 1 a *inversa con opedidos
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    //relacion de 1 a * invers con producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
