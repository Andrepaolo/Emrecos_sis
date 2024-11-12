<div wire:ignore>
    <x-dialog-modal wire:ignore.self wire:model="isOpen" :close-on-click-away="false"> <!-- Desactiva el cierre automático -->
        <x-slot name="title">
            <h3>{{ $material['id'] ? 'Editar Material' : 'Añadir Material' }}</h3>
        </x-slot>

        <x-slot name="content">
            <form>
                <div class="flex justify-between mx-2 mb-6">
                    <!-- Categoría -->
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Categoría" class="font-bold" />
                        <select wire:model.defer="material.mcategory_id" class="w-full border-gray-300 rounded-lg text-gray-800 py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar Categoría</option>
                            @foreach($category as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="material.mcategory_id" />
                    </div>
                </div>
                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Nombre del Material" class="font-bold" />
                        <x-input type="text" wire:model.defer="material.name" class="w-full" />
                        <x-input-error for="material.name" />
                    </div>
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Unidad de Medida" class="font-bold" />
                        <!-- Combo Box (Select) para Unidad de Medida -->
                        <select wire:model.defer="material.unit_id" class="w-full border-gray-300 rounded-lg text-gray-800">
                            <option value="">Seleccionar Unidad</option>
                            @foreach($unidadesDeMedida as $unidad)
                                <option value="{{ $unidad->id }}" class="text-gray-800">{{ $unidad->unidadMedida }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="material.unit_id" />
                    </div>
                </div>

                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Precio Promedio" class="font-bold" />
                        <x-input type="number" wire:model.defer="material.precio_unidad" class="w-full" min="0.1" />
                        <x-input-error for="material.precio_unidad" />
                    </div>

                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="STOCK" class="font-bold" />
                        <x-input type="number" wire:model.defer="material.stock" class="w-full" min="0.1" />
                        <x-input-error for="material.stock" />
                    </div>
                </div>

            </form>
        </x-slot>

        <x-slot name="footer">
            <!-- Botón para cerrar el modal y cancelar la operación con ícono -->
            <x-secondary-button wire:click="$set('isOpen', false)" class="mx-2 bg-red-700">
                <i class="fas fa-times mr-2"></i> Cancelar
            </x-secondary-button>

            <!-- Botón para registrar, con ícono y carga (icono de guardado) -->
            <x-button wire:click.prevent="store" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25 bg-blue-600 text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                <i class="fas fa-save mr-2"></i> Registrar
            </x-button>

            <!-- Indicador de carga -->
            <!-- <span wire:loading wire:target="store">Cargando...</span> -->
        </x-slot>
    </x-dialog-modal>

    @push('js')
    <script>
        window.addEventListener('closeModal', event => {
            let modal = document.querySelector('x-dialog-modal');
            if (modal) {
                modal.remove(); 
            }
        });
    </script>
    @endpush
</div>
