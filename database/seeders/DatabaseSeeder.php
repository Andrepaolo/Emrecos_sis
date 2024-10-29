<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Step;
use App\Models\Unit;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::create([
            'name'=>'Andre Luque Alfaro',
            'email'=>'andre@gmail.com',
            //'profile'=>'https://i.pinimg.com/564x/94/e5/32/94e5325468d2859b075bfabb4dc83c4e.jpg',
            'password'=>bcrypt('12345678')
        ]);
        Product::create([
            'name'=> 'Producto 1',
            'descripcion'=> 'Producto 1 que consta de bastantes cosas xd',
            'fabrication_cost'=> 100.2,
            'precio'=> 200.2,
        ]);
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
        Material::create([
            'name'=> 'Yeso',
            'unit_id'=> '1',
            'precio_unidad'=> 15,
            'stock'=> 10,
        ]);
        Material::create([
            'name'=> 'Metal Laminado',
            'unit_id'=> '2',
            'precio_unidad'=> 15,
            'stock'=> 10,
        ]);
        Material::create([
            'name'=> 'Pintura Laminada',
            'unit_id'=> '3',
            'precio_unidad'=> 15,
            'stock'=> 10,
        ]);
        Material::create([
            'name'=> 'Pegamento ultra fuerte',
            'unit_id'=> '4',
            'precio_unidad'=> 15,
            'stock'=> 10,
        ]);
        Material::create([
            'name'=> 'Cemento',
            'unit_id'=> '5',
            'precio_unidad'=> 15,
            'stock'=> 10,
        ]);
        Step::create([
            'name'=> 'PASO 1',
            'descripcion'=> 'Armado de base',
            'product_id'=>'1',
        ]);
        ProductDetail::create([
            'step_id'=> '1',
            'material_id'=> '2',
            'cantidad'=> 10,
            'preciounit'=>5,
            'total_material'=> 15,
        ]);
        ProductDetail::create([
            'step_id'=> '1',
            'material_id'=> '1',
            'cantidad'=> 10,
            'preciounit'=>5,
            'total_material'=> 15,
        ]);
        ProductDetail::create([
            'step_id'=> '1',
            'material_id'=> '3',
            'cantidad'=> 10,
            'preciounit'=>5,
            'total_material'=> 15,
        ]);
        ProductDetail::create([
            'step_id'=> '1',
            'material_id'=> '4',
            'cantidad'=> 10,
            'preciounit'=>5,
            'total_material'=> 15,
        ]);

    }
}
