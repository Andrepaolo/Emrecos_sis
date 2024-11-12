<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryIngress extends Model
{
    protected $guarded=['id'];
    use HasFactory;
    // Relación con material
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
    // Método para calcular el total (opcional si quieres hacerlo en el modelo)
    public static function calcularTotal($quantity, $pricePerUnit)
    {
        return $quantity * $pricePerUnit;
    }

}
