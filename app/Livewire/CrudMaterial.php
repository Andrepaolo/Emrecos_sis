<?php

namespace App\Livewire;

use App\Models\Material;
use Livewire\Component;
use Livewire\WithPagination;

class CrudMaterial extends Component
{
    use WithPagination;
    public $material;
    public $search;
    public $sortDirection = 'asc'; // Dirección de orden predeterminada
    public $isOpen = false;
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'product.name' => 'required',
        'product.unit_id' => 'required',
        'product.precio_unidad' => 'required|numeric',
        'product.cantidad' => 'required|numeric',
    ];

    public function render()
    {

        $materials = Material::where('name', 'like', '%' . $this->search . '%')
            //->orWhere('descripcion', 'like', '%' . $this->search . '%')
            ->orderBy('id', $this->sortDirection)
            ->paginate(10);


        return view('livewire.crud-material', compact('materials'))
            ->layout('layouts.app');
    }

    public function create()
    {
        $this->isOpen = true;
        $this->material = [ // Inicializa como un array
            'id' => null, // Para evitar el error de clave indefinida
        ];
        $this->resetErrorBag(); // Resetea los errores de validación
    }

    public function store()
    {
        $this->validate();

        if (!empty($this->material['id'])) {
            $material = Material::find($this->material['id']);
            if ($material) {
                $material->update($this->material);
                $message = 'Producto actualizado correctamente';
            } else {
                // Manejo del caso donde no se encuentra el producto
                return;
            }
        } else {
            Material::create($this->material);
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


    public function edit($materialtId)
    {

        $material = Material::find($materialtId);
        if ($material) {
            $this->material = $material->toArray(); // Convierte el modelo a array
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


    public function delete($materialId)
    {
        $material = Material::find($materialId);
        if ($material) {
            $material->delete();
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
        $this->material = [
            'id' => '',
            'name' => '',
            'unit_id' => '',
            'precio_unidad' => '',
            'cantidad' => '',
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
