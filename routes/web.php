<?php

use App\Http\Controllers\ProductController;
use App\Http\Livewire\CrudProduct;
use App\Livewire\PruebaPr;
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

});
