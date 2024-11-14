<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class VistaPD extends Component
{
    public $product;

    public function mount($productId)
    {
        // Obtener el producto con sus pasos e información relacionada
        $this->product = Product::with('steps.productDetails.material')->findOrFail($productId);
    }

    public function render()
    {
        return view('livewire.vista-p-d')
        ->layout('layouts.app');
    }
}
