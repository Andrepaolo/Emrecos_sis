<?php

use App\Http\Controllers\ProductController;
use App\Http\Livewire\CrudProduct;
use App\Http\Livewire\MaterialsManagement;
use App\Livewire\CrudEgreso;
use App\Livewire\CrudIngreso;
use App\Livewire\CrudMaterial;
use App\Livewire\CrudUnit;
use App\Livewire\PruebaPr;
use App\Livewire\VistaM;

use App\Http\Controllers\RoleController;

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //Route::get('/products', CrudProduct::class)->name('product');
    Route::get('/product', PruebaPr::class)->name('product');
    Route::get('/unit', CrudUnit::class)->name('unit');
    Route::get('/material', CrudMaterial::class)->name('material');
    Route::get('/ingreso', CrudIngreso::class)->name('ingreso');
    Route::get('/egreso', CrudEgreso::class)->name('egreso');
    Route::get('/vista', VistaM::class)->name('vista');

    //Route::get('/manages', MaterialsManagement::class)->name('manages');

});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // ... other routes ...

    Route::get('/manage-roles', [RoleController::class, 'index'])->name('manage-roles');
    Route::put('/update-roles', [RoleController::class, 'update'])->name('update-roles');
});
