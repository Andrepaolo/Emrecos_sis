<?php

namespace App\Livewire;

use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class CrudUnit extends Component
{

    use WithPagination;
    public $unit;
    public $search;
    public $sortDirection = 'asc'; // Dirección de orden predeterminada
    public $isOpen = false;
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'unit.unidadMedida' => 'required',
    ];

    //READ del crud xd
    public function render()
    {
        $units = Unit::where('unidadMedida', 'like', '%' . $this->search . '%')
            //->orWhere('descripcion', 'like', '%' . $this->search . '%')-- por si hay mas datos para la bsuqueda
            ->orderBy('id', $this->sortDirection)
            ->paginate(10);

        return view('livewire.crud-unit', compact('units'))
            ->layout('layouts.app');
    }
    //funciones CRUD
    //C-create
    public function create()
    {
        $this->isOpen = true;
        $this->unit = [ // Inicializa como un array
            'id' => null, // Para evitar el error de clave indefinida
        ];
        $this->resetErrorBag(); // Resetea los errores de validación
    }


    public function store()
    {
        $this->validate();

        if (!empty($this->unit['id'])) {
            $unit = Unit::find($this->unit['id']);
            if ($unit) {
                $unit->update($this->unit);
                $message = 'Unidad de Medidad actualizada correctamente';
            } else {
                // Manejo del caso donde no se encuentra el producto
                return;
            }
        } else {
            Unit::create($this->unit);
            $message = 'Unidad de Medidad creada correctamente';
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

    //U- update
    public function edit($productId)
    {

        $unit = Unit::find($productId);
        if ($unit) {
            $this->unit = $unit->toArray(); // Convierte el modelo a array
            $this->isOpen = true; // Abre el modal
            $this->dispatch('open-modal');
        } else {
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Unidad de Medida no encontrada',
                position: 'center'
            );
        }
    }

    //D-DELETE
    public function delete($unitsId)
    {
        $unit = Unit::find($unitsId);
        if ($unit) {
            $unit->delete();
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
                title: 'Unidad de Medida no encontrada',
                position: 'center'
            );
        }

        $this->resetComponent(); // Resetea el componente
    }

    //reset para evitar errores
    private function resetComponent()
    {
        $this->isOpen = false;
        $this->unit = [
            'id' => '',
            'unidadMedida' => '',
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
