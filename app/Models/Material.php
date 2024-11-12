<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = ['mcategory_id','name', 'unit_id', 'precio_unidad', 'stock'];

    //relacion * a 1 coon unidad de medida
    public function unit()
    {
        return $this->belongsTo(Unit::class,'unit_id');
    }
    public function mcategory()
    {
        return $this->belongsTo(Mcategory::class,'mcategory_id');
    }

    //relacion 1 a * producto detalle
    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }

    //relacion de 1 a muchos con ingresos
    public function ingresos()
    {
        return $this->hasMany(InventoryIngress::class);
    }

    //relacion de 1 a muchos con egresos
    public function egresos()
    {
        return $this->hasMany(InventoryEgress::class);
    }

    //funcion para actualizar stock
    public function actualizarStock($stock)
    {
        $this->stock += $stock;
        $this->save();
    }

}
