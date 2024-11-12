<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcategory extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'category'];
     //relacion 1 a * con materiales +
     public function materials()
    {
        return $this->hasMany(Material::class, 'mcategory_id');
    }
}
