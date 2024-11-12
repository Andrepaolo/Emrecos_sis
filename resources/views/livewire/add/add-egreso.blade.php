<div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-500 bg-opacity-20">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-lg font-bold mb-4">Registrar Egreso de Material</h2>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <!-- Cantidad a Egresar -->
            <div class="col-span-1">
                <label class="block mb-2">Cantidad a Egresar:</label>
                <input type="number" wire:model="quantity" class="w-full p-2 border border-gray-300 rounded" min="1" placeholder="Ingresa la cantidad">
            </div>

            <!-- Responsable -->
            <div class="col-span-1">
                <label class="block mb-2">Responsable:</label>
                <input type="text" wire:model="responsable" class="w-full p-2 border border-gray-300 rounded" placeholder="Nombre del responsable">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <!-- Cliente -->
            <div class="col-span-1">
                <label class="block mb-2">Cliente:</label>
                <select wire:model="cliente" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Selecciona un cliente</option>
                    <option value="SANCUS">SANCUS</option>
                    <option value="MEXICO">MEXICO</option>
                    <option value="EMPRESA">EMPRESA</option>
                    <option value="TRABAJADOR">TRABAJADOR</option>
                    <option value="GOB PUNO">GOB PUNO</option>
                    <option value="ING. YHOSIMAR">ING. YHOSIMAR</option>
                    <option value="LOLI">LOLI</option>
                    <option value="JOSE SIERRA">JOSE SIERRA</option>
                    <option value="VILQUE">VILQUE</option>
                    <option value="CABANILLAS">CABANILLAS</option>
                </select>
            </div>

            <!-- Tipo de Egreso -->
            <div class="col-span-1">
                <label class="block mb-2">Tipo de Egreso:</label>
                <select wire:model="destination" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Selecciona tipo de egreso</option>
                    <option value="produccion">Producción</option>
                    <option value="desecho">Desecho</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 mb-4">
            <!-- Observaciones -->
            <div class="col-span-1">
                <label class="block mb-2">Observaciones:</label>
                <textarea wire:model="observaciones" class="w-full p-2 border border-gray-300 rounded" placeholder="Escribe cualquier observación"></textarea>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <!-- Botones de acción -->
            <button wire:click="registerEgreso" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Registrar</button>
            <button wire:click="closeModal" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancelar</button>
        </div>
    </div>
</div>