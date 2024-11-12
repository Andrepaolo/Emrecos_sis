<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    //relacion 1 a * con pedido
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
