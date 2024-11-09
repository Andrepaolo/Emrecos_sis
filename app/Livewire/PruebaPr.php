<?php

namespace App\Livewire;

use App\Models\Product;

use Livewire\Component;
use Livewire\WithPagination;

class PruebaPr extends Component
{
    use WithPagination;
    public $product;
    public $search;
    public $sortDirection = 'asc'; // Dirección de orden predeterminada
    public $isOpen = false;

    protected $listeners = ['render', 'delete' => 'delete'];


    protected $rules = [
        'product.name' => 'required',
        'product.descripcion' => 'required',
        'product.fabrication_cost' => 'required|numeric',
        'product.precio' => 'required|numeric',
    ];

    public function render()
    {

        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('descripcion', 'like', '%' . $this->search . '%')
            ->orderBy('id', $this->sortDirection)
            ->paginate(10);


        return view('livewire.prueba-pr', compact('products'))
            ->layout('layouts.app');
    }

    public function create()
    {
        $this->isOpen = true;
        $this->product = [ // Inicializa como un array
            'id' => null, // Para evitar el error de clave indefinida
        ];
        $this->resetErrorBag(); // Resetea los errores de validación
    }

    public function store()
    {
        $this->validate();

        if (!empty($this->product['id'])) {
            $product = Product::find($this->product['id']);
            if ($product) {
                $product->update($this->product);
                $message = 'Producto actualizado correctamente';
            } else {
                // Manejo del caso donde no se encuentra el producto
                return;
            }
        } else {
            Product::create($this->product);
            $message = 'Producto creado correctamente';
        }

        $this->resetComponent(); // Resetea el componente

        $this->dispatch(
            'alert',
            type: 'success',
            title: $message,
            position: 'center'
        );
        $this->dispatch('close-modal');
    }


    public function edit($productId)
    {

        $product = Product::find($productId);
        if ($product) {
            $this->product = $product->toArray(); // Convierte el modelo a array
            $this->isOpen = true; // Abre el modal
            $this->dispatch('open-modal');
        } else {
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Producto no encontrado',
                position: 'center'
            );
        }
    }


    public function delete($productId)
    {
        $product = Product::find($productId);
        if ($product) {
            $product->delete();
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Se borró correctamente',
                position: 'center'
            );
        } else {
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Producto no encontrado',
                position: 'center'
            );
        }

        $this->resetComponent(); // Resetea el componente
    }
    private function resetComponent()
    {
        $this->isOpen = false;
        $this->product = [
            'id' => '',
            'name' => '',
            'descripcion' => '',
            'fabrication_cost' => '',
            'precio' => '',
        ];
        $this->resetErrorBag(); // Resetea los errores de validación
    }
    //funciones de ordenamiento
    public function sortAsc()
    {
        $this->sortDirection = 'asc';
    }

    public function sortDesc()
    {
        $this->sortDirection = 'desc';
    }



}
