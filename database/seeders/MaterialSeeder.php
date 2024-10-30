<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\ProductDetail;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Unit::create([
            'unidadMedida'=> 'KG(kilos)',
        ]);
        Unit::create([
            'unidadMedida'=> 'Planchas',
        ]);
        Unit::create([
            'unidadMedida'=> 'Galones',
        ]);
        Unit::create([
            'unidadMedida'=> 'Litros',
        ]);
        Unit::create([
            'unidadMedida'=> 'Bolsas',
        ]);
        ProductDetail::create([
            'product_id'=> '1',
            'material_id'=> '2',
            'Paso'=> 'Armar',
            'cantidad'=> '10',
            'total_material'=> '',
        ]);
        ProductDetail::create([
            'product_id'=> '1',
            'material_id'=> '1',
            'Paso'=> 'Armar',
            'cantidad'=> '10',
            'total_material'=> '',
        ]);
        ProductDetail::create([
            'product_id'=> '1',
            'material_id'=> '3',
            'Paso'=> 'Armar',
            'cantidad'=> '10',
            'total_material'=> '',
        ]);
        ProductDetail::create([
            'product_id'=> '1',
            'material_id'=> '4',
            'Paso'=> 'Armar',
            'cantidad'=> '10',
            'total_material'=> '',
        ]);
        Material::create([
            'name'=> 'Yeso',
            'unit_id'=> '1',
            'precio_unidad'=> '15',
            'cantidad'=> '10',
        ]);
        Material::create([
            'name'=> 'Metal Laminado',
            'unit_id'=> '2',
            'precio_unidad'=> '15',
            'cantidad'=> '10',
        ]);
        Material::create([
            'name'=> 'Pintura Laminada',
            'unit_id'=> '3',
            'precio_unidad'=> '15',
            'cantidad'=> '10',
        ]);
        Material::create([
            'name'=> 'Pegamento ultra fuerte',
            'unit_id'=> '4',
            'precio_unidad'=> '15',
            'cantidad'=> '10',
        ]);
        Material::create([
            'name'=> 'Cemento',
            'unit_id'=> '5',
            'precio_unidad'=> '15',
            'cantidad'=> '10',
        ]);

    }
}
