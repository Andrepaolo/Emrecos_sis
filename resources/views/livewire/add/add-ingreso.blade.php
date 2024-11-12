<div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-500 bg-opacity-20">
    <div class="bg-white p-6 rounded-lg shadow-lg w-3/4 md:w-1/2 lg:w-1/3 relative z-60">
        <h2 class="text-lg font-bold mb-4">Registrar Ingreso de Material</h2>

        <!-- Fila de Inputs: Cantidad y Tipo -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block mb-2">Cantidad a Ingresar:</label>
                <input type="number" wire:model="quantity" min="1" class="w-full p-2  border border-gray-300 rounded" min="1" placeholder="Ingresar cantidad">
            </div>

            <div>
                <label class="block mb-2">Tipo de Documento</label>
                <input type="text" wire:model="tipo" class="w-full p-2 border border-gray-300 rounded" placeholder="Ingresar tipo">
            </div>
        </div>

        <!-- Fila de Inputs: Serie, Número, RUC y Proveedor -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block mb-2">Serie</label>
                <input type="text" wire:model="serie" class="w-full p-2 border border-gray-300 rounded" placeholder="Ingresar serie">
            </div>

            <div>
                <label class="block mb-2">Número</label>
                <input type="text" wire:model="numero" class="w-full p-2 border border-gray-300 rounded" placeholder="Ingresar número">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block mb-2">RUC</label>
                <input type="text" wire:model="RUC" class="w-full p-2 border border-gray-300 rounded" placeholder="Ingresar RUC">
            </div>

            <div>
                <label class="block mb-2">Proveedor</label>
                <input type="text" wire:model="proveedor" class="w-full p-2 border border-gray-300 rounded" placeholder="Ingresar proveedor">
            </div>
        </div>

        <!-- Observación (Textarea) -->
        <label class="block mb-2">Observaciones</label>
        <input type="text" wire:model="observacion" class="w-full p-2 border border-gray-300 rounded" placeholder="Ingresar observación">

        <!-- Botones -->
        <div class="flex justify-end space-x-4 mt-4">
            <button wire:click="registerIngreso" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Registrar</button>
            <button wire:click="closeModal" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancelar</button>
        </div>
    </div>
</div>