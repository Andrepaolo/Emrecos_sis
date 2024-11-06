<?php

namespace App\Livewire;

use App\Models\InventoryEgress;
use App\Models\InventoryIngress;
use App\Models\Material;
use Livewire\Component;
use Livewire\WithPagination;

class CrudMaterial extends Component
{
    use WithPagination;

    public $material;
    public $search;
    public $sortDirection = 'asc';
    public $isOpen = false;
    public $showIngresoModal = false;
    public $showEgresoModal = false;
    public $quantity = 0; // Nueva variable para la cantidad
    public $selectedMaterialId;
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'material.name' => 'required',
        'material.unit_id' => 'required',
        'material.precio_unidad' => 'required|numeric',
        'material.stock' => 'required|numeric',
    ];

    public function render()
    {
        $materials = Material::where('name', 'like', '%' . $this->search . '%')
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

    // Método para registrar un ingreso
    // Abre el modal para registrar ingreso
    public function openIngresoModal($materialId)
    {
        $this->selectedMaterialId = $materialId;
        $this->quantity = 0;
        $this->showIngresoModal = true;
    }

    // Abre el modal para registrar egreso
    public function openEgresoModal($materialId)
    {
        $this->selectedMaterialId = $materialId;
        $this->quantity = 0;
        $this->showEgresoModal = true;
    }

    // Función para registrar el ingreso de materiales
    public function registerIngreso()
    {
        $material = Material::find($this->selectedMaterialId);
        if ($material) {
            $totalPrice = $this->quantity * $material->precio_unidad;

            InventoryIngress::create([
                'material_id' => $material->id,
                'quantity' => $this->quantity,
                'price_per_unit' => $material->precio_unidad,
                'total_price' => $totalPrice,
                'date' => now(),
            ]);

            $material->actualizarStock($this->quantity);

            $this->dispatch(
                'alert',
                type: 'success',
                title: "Ingreso registrado correctamente",
                position: 'center'
            );

            $this->closeModal();
        }
    }

    // Función para registrar el egreso de materiales
    public function registerEgreso()
    {
        $material = Material::find($this->selectedMaterialId);
        if ($material && $material->stock >= $this->quantity) {
            InventoryEgress::create([
                'material_id' => $material->id,
                'quantity' => $this->quantity,
                'date' => now(),
                'destination' => 'producción',
            ]);

            $material->actualizarStock(-$this->quantity);

            $this->dispatch(
                'alert',
                type: 'success',
                title: "Egreso registrado correctamente",
                position: 'center'
            );

            $this->closeModal();
        } else {
            $this->dispatch(
                'alert',
                type: 'error',
                title: "No hay suficiente stock para realizar el egreso",
                position: 'center'
            );
        }
    }

    // Función para cerrar los modales
    public function closeModal()
    {
        $this->showIngresoModal = false;
        $this->showEgresoModal = false;
        $this->quantity = 0;
    }

    private function resetComponent()
    {
        $this->isOpen = false;
        $this->material = [
            'id' => '',
            'name' => '',
            'unit_id' => '',
            'precio_unidad' => '',
            'stock' => '',
        ];
        $this->resetErrorBag(); // Resetea los errores de validación
    }

    // Funciones de ordenamiento
    public function sortAsc()
    {
        $this->sortDirection = 'asc';
    }

    public function sortDesc()
    {
        $this->sortDirection = 'desc';
    }
}
