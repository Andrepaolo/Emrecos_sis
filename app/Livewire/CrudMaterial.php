<?php

namespace App\Livewire;

use App\Models\InventoryEgress;
use App\Models\InventoryIngress;
use App\Models\Material;
use App\Models\Mcategory;
use App\Models\Unit;
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
    public $quantity = 1; // Nueva variable para la cantidad
    public $observacion, $tipo,$serie,$numero,$RUC, $proveedor;
    public $destination, $cliente, $responsable, $observaciones;
    public $selectedMaterialId;
    public $unidadesDeMedida;  // Unidades de medida disponibles
    public $category;  // Unidades de medida disponibles

    public function mount()
    {
        $this->category = Mcategory::all();
        $this->unidadesDeMedida = Unit::all();  // Cargar todas las unidades de medida
          // Cargar todas las unidades de medida
    }
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'material.mcategory_id' => 'required',
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
        $this->quantity = 1;
        $this->showIngresoModal = true;
    }

    // Abre el modal para registrar egreso
    public function openEgresoModal($materialId)
    {
        $this->selectedMaterialId = $materialId;
        $this->quantity = 1;
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
                'observaciones' => $this->observacion,
                'tipo' => $this->tipo,             // Agregado
                'serie' => $this->serie,           // Agregado
                'numero' => $this->numero,         // Agregado
                'RUC' => $this->RUC,               // Agregado
                'proveedor' => $this->proveedor,   // Agregado
            ]);
            $this->reset([
                'quantity', 'tipo', 'serie', 'numero', 'RUC', 'proveedor', 'observacion'
            ]);

            $material->actualizarStock($this->quantity);

            $this->dispatch(
                'alert',
                type: 'success',
                icon: 'success',
                title: "Ingreso registrado correctamente",
                position: 'center'
            );

            $this->closeModal();
        }
    }


    // Función para registrar el egreso de materiales
    public function registerEgreso()
    {
        // Verificar si el material seleccionado existe y tiene suficiente stock
        $material = Material::find($this->selectedMaterialId);

        if (!$material) {
            $this->dispatch(
                'alert',
                type: 'error',
                icon: 'error',
                title: "Error",
                text: "Material no encontrado.",
                position: 'center'
            );
            return;
        }

        if ($material->stock < $this->quantity) {
            $this->dispatch(
                'alert',
                type: 'error',
                icon: 'error',
                title: "Error",
                text: "No hay suficiente stock para realizar el egreso.",
                position: 'center'
            );
            return;
        }

        // Registrar el egreso en la tabla 'inventory_egresses'
        InventoryEgress::create([
            'material_id' => $material->id,
            'quantity' => $this->quantity,
            'date' => now(),
            'destination' => $this->destination,
            'cliente' => $this->cliente,
            'responsable' => $this->responsable,
            'observaciones' => $this->observaciones,
            //'user_id' => auth()->id(),
        ]);

        // Actualizar el stock del material
        $material->actualizarStock(-$this->quantity);

        // Limpiar los valores después de registrar
        $this->reset(['quantity', 'responsable', 'cliente', 'destination', 'observaciones']);

        // Mensaje de éxito
        $this->dispatch(
            'alert',
            type: 'success',
            icon: 'success',
            title: "Egreso registrado correctamente",
            position: 'center'
        );

        $this->closeModal();
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
            'category_id' => '',
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
