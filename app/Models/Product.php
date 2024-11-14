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
    public function steps()
    {
        return $this->hasMany(Step::class);
    }
    //relacion 1 a * pedidos
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    // En el modelo Product.php
    public function calculateFabricationCost()
    {
        $totalFabricationCost = $this->steps->sum(function ($step) {
            return $step->productDetails->sum(function ($detail) {
                return $detail->cantidad * $detail->preciounit;
            });
        });

        $this->fabrication_cost = $totalFabricationCost;
        $this->save();
    }

}
