<div wire:ignore>
    <x-dialog-modal wire:ignore.self wire:model="isOpen" :close-on-click-away="false"> <!-- Desactiva el cierre automático -->
        <x-slot name="title">
            <h3>{{ $product['id'] ? 'Editar Producto' : 'Añadir Nuevo Producto' }}</h3>
        </x-slot>

        <x-slot name="content">
            <form>
                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Nombre" class="font-bold" />
                        <x-input type="text" wire:model.defer="product.name" class="w-full" />
                        <x-input-error for="product.name" />
                    </div>
                </div>

                <div class="flex justify-between mx-2 mb-6">
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Descripción" class="font-bold" />
                        <x-input type="text" wire:model.defer="product.descripcion" class="w-full" />
                        <x-input-error for="product.descripcion" />
                    </div>

                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Costo de Fabricación" class="font-bold" />
                        <x-input type="number" wire:model.defer="product.fabrication_cost" class="w-full" />
                        <x-input-error for="product.fabrication_cost" />
                    </div>

                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Precio" class="font-bold" />
                        <x-input type="number" wire:model.defer="product.precio" class="w-full" />
                        <x-input-error for="product.precio" />
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <!-- Botón para cerrar el modal y cancelar la operación -->
            <x-secondary-button wire:click="$set('isOpen', false)" class="mx-2">
                Cancelar
            </x-secondary-button>

            <!-- Botón para registrar, previene la recarga de la página con prevent y añade lógica para el estado de carga -->
            <x-button wire:click.prevent="store" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
                Registrar
            </x-button>

            <!-- Indicador de carga -->
            <!-- <span wire:loading wire:target="store">Cargando...</span>-->
        </x-slot>
    </x-dialog-modal>

    @push('js')
    <script>
        window.addEventListener('closeModal', event => {
            // Aquí coloca el código para cerrar el modal desde el frontend
            let modal = document.querySelector('x-dialog-modal');
            if (modal) {
                modal.remove(); // O cualquier otra forma de cerrar el modal
            }
        });
    </script>
    @endpush
</div>
