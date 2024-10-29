<?php

namespace App\Livewire;

use App\Models\Cashbox;
use App\Models\InventoryIngress as ModelsInventoryIngress;
use App\Models\Material;
use Illuminate\Http\Request;
use Livewire\Component;

class InventoryIngress extends Component
{
    public function render()
    {
        return view('livewire.inventory-ingress');
    }
    public function store(Request $request)
{
    // Registrar el ingreso de materiales
    $ingress = new ModelsInventoryIngress();
    $ingress->material_id = $request->input('material_id');
    $ingress->quantity = $request->input('quantity');
    $ingress->price_per_unit = $request->input('price_per_unit');
    $ingress->total_price = $request->input('quantity') * $request->input('price_per_unit');
    $ingress->date = $request->input('date');
    $ingress->source = $request->input('source');
    //$ingress->user_id = auth()->id();
    $ingress->save();

    // Actualizar el stock en la tabla de materiales
    $material = Material::find($request->input('material_id'));
    $material->stock += $request->input('quantity');
    $material->save();

    // Registrar el gasto en la tabla de Cashbox
    $cashbox = new Cashbox();
    $cashbox->type = 'egreso'; // Es un egreso de dinero
    $cashbox->amount = $ingress->total_price;
    $cashbox->description = 'Compra de ' . $material->name . ' (' . $ingress->quantity . ' unidades)';
    //$cashbox->user_id = auth()->id();
    $cashbox->save();

    return redirect()->back()->with('success', 'Ingreso registrado exitosamente y gasto en caja actualizado');
}

}
