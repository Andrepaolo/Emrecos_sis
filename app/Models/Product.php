<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'descripcion',
        'fabrication_cost',
        'precio',
    ];
    //relacion 1 a * con productos deail
    public function step()
    {
        return $this->hasMany(Step::class);
    }
    //relacion 1 a * pedidos
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
