<?php
namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class CrudProduct extends Component
{
    public $product, $search;
    public $isOpen = false;

    protected $rules = [
        'product.nombre' => 'required',
        'product.descripcion' => 'required',
        'product.fabrication_cost' => 'nullable',
        'product.precio' => 'nullable',
    ];

    public function render() {
        $products = Product::where('nombre', 'like', '%'.$this->search.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(10);
        return view('livewire.crud-product', compact('products'));
    }

    public function create() {
        $this->isOpen = true;
        $this->reset(['product']);
    }

    public function store() {
        $this->validate();
        if (!isset($this->product->id)) {
            Product::create($this->product);
        } else {
            $this->product->save();
        }
        $this->reset(['isOpen', 'product']);
        $this->emitTo('CrudProduct', 'render');
        $this->emit('alert', 'Producto guardado exitosamente');
    }

    public function edit(Product $product) {
        $this->product = $product;
        $this->isOpen = true;
    }

    public function delete(Product $product) {
        $product->delete();
    }
}
