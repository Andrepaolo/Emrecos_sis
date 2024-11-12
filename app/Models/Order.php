<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    //relacion 1 a * inversa con cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    //relacion de 1 a * con detalles de pedido
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
