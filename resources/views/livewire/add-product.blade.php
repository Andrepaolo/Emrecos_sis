<!-- resources/views/livewire/add-product.blade.php -->
<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Nuevo Producto</h3>
        </x-slot>

        <x-slot name="content">
            <div class="flex justify-between mx-2 mb-6">
                <!-- Campo para el nombre del producto -->
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Nombre del Producto" class="font-bold"/>
                    <x-input type="text" wire:model.defer="product.name" class="w-full"/>
                    <x-input-error for="product.name"/>
                </div>

                <!-- Campo para la descripción -->
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Descripción" class="font-bold"/>
                    <x-input type="text" wire:model.defer="product.descripcion" class="w-full"/>
                    <x-input-error for="product.descripcion"/>
                </div>

                <!-- Campo para el precio -->
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Costo de Fabricación" class="font-bold"/>
                    <x-input type="number" wire:model.defer="product.fabrication_cost" class="w-full"/>
                    <x-input-error for="product.fabrication_cost"/>
                </div>
                <div class="mb-2 md:mr-2 md:mb-0 w-full">
                    <x-label value="Precio" class="font-bold"/>
                    <x-input type="number" wire:model.defer="product.precio" class="w-full"/>
                    <x-input-error for="product.precio"/>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpen', false)" class="mx-2">Cancelar</x-secondary-button>

            <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
                Registrar
            </x-button>

            <span wire:loading wire:target="store">Cargando...</span>
        </x-slot>
    </x-dialog-modal>

    @push('js')
    @endpush
</div>
