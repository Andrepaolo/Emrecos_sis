<?php

namespace App\Livewire;

use App\Models\InventoryIngress;
use Livewire\Component;
use Livewire\WithPagination;

class CrudIngreso extends Component
{

    use WithPagination;
    public $ingreso;
    public $search;
    public $sortDirection = 'asc'; // Dirección de orden predeterminada
    public $isOpen = false;
    public $vistaActiva = 'vista1';
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'ingreso.material_id' => 'required',
        'ingreso.quantity' => 'required',
        'ingreso.price_per_unit' => 'required|numeric',
        'ingreso.total_price' => 'required|numeric',
        'ingreso.total_price' => 'required|numeric',
        'ingreso.observaciones' => 'required',
    ];

    public function render()
    {

        $ingresos = InventoryIngress::where('material_id', 'like', '%' . $this->search . '%')
            //>orWhere('descripcion', 'like', '%' . $this->search . '%')
            ->orderBy('id', $this->sortDirection)
            ->paginate(10);


        return view('livewire.crud-ingreso', compact('ingresos'))
            ->layout('layouts.app');
    }

    public function create()
    {
        $this->isOpen = true;
        $this->ingreso = [ // Inicializa como un array
            'id' => null, // Para evitar el error de clave indefinida
        ];
        $this->resetErrorBag(); // Resetea los errores de validación
    }

    public function store()
    {
        $this->validate();

        if (!empty($this->ingreso['id'])) {
            $ingreso = InventoryIngress::find($this->ingreso['id']);
            if ($ingreso) {
                $ingreso->update($this->ingreso);
                $message = 'Producto actualizado correctamente';
            } else {
                // Manejo del caso donde no se encuentra el producto
                return;
            }
        } else {
            InventoryIngress::create($this->ingreso);
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


    public function edit($ingresoId)
    {

        $ingreso = InventoryIngress::find($ingresoId);
        if ($ingreso) {
            $this->ingreso = $ingreso->toArray(); // Convierte el modelo a array
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


    public function delete($ingresoId)
    {
        $ingreso = InventoryIngress::find($ingresoId);
        if ($ingreso) {
            $ingreso->delete();
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
        $this->ingreso = [
            'id' => '',
            'material_id' => '',
            'quantity' => '',
            'price_per_unit' => '',
            'total_price' => '',
            'date' => '',
            'observaciones' => '',
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
