<?php

namespace App\Livewire;

use App\Models\Step;
use Livewire\Component;
use Livewire\WithPagination;

class CrudStep extends Component
{
    use WithPagination;
    public $step;
    public $search;
    public $sortDirection = 'asc'; // Dirección de orden predeterminada
    public $isOpen = false;
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'step.name' => 'required',
        'step.descripcion' => 'required',
        'step.cost' => 'required',
        'step.product_id' => 'required',
    ];

    //READ del crud xd
    public function render()
    {
        $steps = Step::where('name', 'like', '%' . $this->search . '%')
            //->orWhere('descripcion', 'like', '%' . $this->search . '%')-- por si hay mas datos para la bsuqueda
            ->orderBy('id', $this->sortDirection)
            ->paginate(10);

        return view('livewire.crud-step', compact('steps'))
            ->layout('layouts.app');
    }
    //funciones CRUD
    //C-create
    public function create()
    {
        $this->isOpen = true;
        $this->step = [ // Inicializa como un array
            'id' => null, // Para evitar el error de clave indefinida
        ];
        $this->resetErrorBag(); // Resetea los errores de validación
    }


    public function store()
    {
        $this->validate();

        if (!empty($this->step['id'])) {
            $step = Step::find($this->step['id']);
            if ($step) {
                $step->update($this->step);
                $message = 'Paso actualizado correctamente';
            } else {
                // Manejo del caso donde no se encuentra el producto
                return;
            }
        } else {
            Step::create($this->step);
            $message = 'Paso creado correctamente';
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

        $step = Step::find($productId);
        if ($step) {
            $this->step = $step->toArray(); // Convierte el modelo a array
            $this->isOpen = true; // Abre el modal
            $this->dispatch('open-modal');
        } else {
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Paso no encontrado',
                position: 'center'
            );
        }
    }

    //D-DELETE
    public function delete($stepsId)
    {
        $step = Step::find($stepsId);
        if ($step) {
            $step->delete();
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
                title: 'Paso no encontrado',
                position: 'center'
            );
        }

        $this->resetComponent(); // Resetea el componente
    }

    //reset para evitar errores
    private function resetComponent()
    {
        $this->isOpen = false;
        $this->step = [
            'id' => '',
            'name' => '',
            'descripcion' => '',
            'cost' => '',
            'product_id' => '',
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
