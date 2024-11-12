<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Mcategory;
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
            'unidadMedida'=> 'KG(kilogramos)',
        ]);
        Unit::create([
            'unidadMedida'=> 'Balon',
        ]);
        Unit::create([
            'unidadMedida'=> 'Pares',
        ]);
        Unit::create([
            'unidadMedida'=> 'Metros',
        ]);
        Unit::create([
            'unidadMedida'=> 'Unidades',
        ]);
        Mcategory::create([
            'category'=> 'ABRASIVOS',
        ]);
        Mcategory::create([
            'category'=> 'GASES INFLAMABLES',
        ]);
        Mcategory::create([
            'category'=> 'INDUMENTARIA',
        ]);
        Mcategory::create([
            'category'=> 'MANGUERA ',
        ]);
        Mcategory::create([
            'category'=> 'CERROJO ',
        ]);

        Material::create([
            'name'=> 'ALAMBRE DE SOLADURA SOID WIRE 0,8MM',
            'mcategory_id'=>'1',
            'unit_id'=> '1',
            'precio_unidad'=> 15,
            'stock'=> 4,
        ]);
        Material::create([
            'name'=> 'PROPANO',
            'mcategory_id'=>'2',
            'unit_id'=> '2',
            'precio_unidad'=> 15,
            'stock'=> 5,
        ]);
        Material::create([
            'name'=> 'GUANTES CUERO PLOMOS LARGOS',
            'mcategory_id'=>'3',
            'unit_id'=> '3',
            'precio_unidad'=> 15,
            'stock'=> 2,
        ]);
        Material::create([
            'name'=> 'MANGUERA DE AIRE 12X08',
            'mcategory_id'=>'4',
            'unit_id'=> '4',
            'precio_unidad'=> 15,
            'stock'=> 1,
        ]);
        Material::create([
            'name'=> ' CERROJO ACERO INOX  X2 PULG.',
            'mcategory_id'=>'5',
            'unit_id'=> '5',
            'precio_unidad'=> 15,
            'stock'=> 2,
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
