<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $guarded=['id'];
     //relacion 1 a * con materiales +
     public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
