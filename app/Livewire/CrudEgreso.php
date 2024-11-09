<?php

namespace App\Livewire;

use App\Models\InventoryEgress;
use Livewire\Component;
use Livewire\WithPagination;

class CrudEgreso extends Component
{

    use WithPagination;
    public $egreso;
    public $search;
    public $sortDirection = 'asc'; // Dirección de orden predeterminada
    public $isOpen = false;
    public $vistaActiva = 'vista1';
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'ingreso.material_id' => 'required',
        'ingreso.quantity' => 'required',
        'ingreso.date' => 'required',
        'ingreso.destination' => 'required',
    ];

    public function render()
    {

        $egresos = InventoryEgress::where('material_id', 'like', '%' . $this->search . '%')
            //>orWhere('descripcion', 'like', '%' . $this->search . '%')
            ->orderBy('id', $this->sortDirection)
            ->paginate(10);


        return view('livewire.crud-egreso', compact('egresos'))
            ->layout('layouts.app');
    }

    public function create()
    {
        $this->isOpen = true;
        $this->egreso = [ // Inicializa como un array
            'id' => null, // Para evitar el error de clave indefinida
        ];
        $this->resetErrorBag(); // Resetea los errores de validación
    }

    public function store()
    {
        $this->validate();

        if (!empty($this->egreso['id'])) {
            $egreso = InventoryEgress::find($this->egreso['id']);
            if ($egreso) {
                $egreso->update($this->egreso);
                $message = 'Producto actualizado correctamente';
            } else {
                // Manejo del caso donde no se encuentra el producto
                return;
            }
        } else {
            InventoryEgress::create($this->egreso);
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


    public function edit($egresoId)
    {

        $egreso = InventoryEgress::find($egresoId);
        if ($egreso) {
            $this->egreso = $egreso->toArray(); // Convierte el modelo a array
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


    public function delete($egresoId)
    {
        $egreso = InventoryEgress::find($egresoId);
        if ($egreso) {
            $egreso->delete();
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
        $this->egreso = [
            'id' => '',
            'material_id' => '',
            'quantity' => '',
            'date' => '',
            'destination' => '',


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


