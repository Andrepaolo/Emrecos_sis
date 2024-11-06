<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryEgress extends Model
{
    protected $guarded=['id'];
    use HasFactory;
    // Relación con material
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
