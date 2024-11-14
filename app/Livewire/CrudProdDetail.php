<?php

namespace App\Livewire;

use App\Models\ProductDetail;
use Livewire\Component;
use Livewire\WithPagination;

class CrudProdDetail extends Component
{
    use WithPagination;
    public $prdetail;
    public $search;
    public $sortDirection = 'asc'; // Dirección de orden predeterminada
    public $isOpen = false;
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'prdetail.step_id' => 'required',
        'prdetail.material_id' => 'required',
        'prdetail.cantidad' => 'required',
        'prdetail.preciounit' => 'required',
        'prdetail.total_material' => 'required',
    ];

    //READ del crud xd
    public function render()
    {
        $prdetails = ProductDetail::where('step_id', 'like', '%' . $this->search . '%')
            //->orWhere('descripcion', 'like', '%' . $this->search . '%')-- por si hay mas datos para la bsuqueda
            ->orderBy('id', $this->sortDirection)
            ->paginate(10);

        return view('livewire.crud-prod-detail', compact('prdetails'))
            ->layout('layouts.app');
    }
    //funciones CRUD
    //C-create
    public function create()
    {
        $this->isOpen = true;
        $this->prdetail = [ // Inicializa como un array
            'id' => null, // Para evitar el error de clave indefinida
        ];
        $this->resetErrorBag(); // Resetea los errores de validación
    }


    public function store()
    {
        $this->validate();

        if (!empty($this->prdetail['id'])) {
            $prdetail = ProductDetail::find($this->prdetail['id']);
            if ($prdetail) {
                $prdetail->update($this->prdetail);
                $message = 'Paso actualizado correctamente';
            } else {
                // Manejo del caso donde no se encuentra el producto
                return;
            }
        } else {
            ProductDetail::create($this->step);
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
    public function edit($prdetailId)
    {

        $prdetail = ProductDetail::find($prdetailId);
        if ($prdetail) {
            $this->prdetail = $prdetail->toArray(); // Convierte el modelo a array
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
    public function delete($prdetailsId)
    {
        $prdetail = ProductDetail::find($prdetailsId);
        if ($prdetail) {
            $prdetail->delete();
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
        $this->prdetail = [
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
