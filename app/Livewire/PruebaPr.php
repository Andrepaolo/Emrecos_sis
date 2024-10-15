<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class PruebaPr extends Component
{
    public $search;
    public $isOpen = false;
    protected $listeners = ['render', 'delete' => 'delete'];
    public $product = [ // Asegúrate de que esto esté presente
        'name' => '',
        'descripcion' => '',
        'fabrication_cost' => '',
        'precio' => '',
    ];

    protected $rules = [
        'product.name' => 'required',
        'product.descripcion' => 'required',
        'product.fabrication_cost' => 'required|numeric',
        'product.precio' => 'required|numeric',
    ];

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.prueba-pr', compact('products'))
        ->layout('layouts.app');
    }

    public function create()
    {
        $this->isOpen = true;
        $this->product = [ // Asegúrate de que esto esté presente
            'name' => '',
            'descripcion' => '',
            'fabrication_cost' => '',
            'precio' => '',
        ];
        $this->reset(['product']);
    }

    public function store()
    {
        $this->validate();

        if (!isset($this->product['id'])) {
            Product::create($this->product);
        } else {
            $this->product->save();
        }

        $this->reset(['isOpen', 'product']);
        $this->emitTo('PruebaPr', 'render');
        $this->emit('alert', 'Registro creado satisfactoriamente');
    }

    public function edit(Product $product)
    {
        $this->product = $product;
        $this->isOpen = true;
    }

    public function delete(Product $product)
    {
        $product->delete();
    }


}
