<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            <h3>Añadir nuevo Producto</h3>
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
                        <x-label value="Fecha de Inicio" class="font-bold" />
                        <x-input type="text" wire:model.defer="product.descripcion" class="w-full" />
                        <x-input-error for="product.descripcion" />
                    </div>
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Fecha a Finalizar" class="font-bold" />
                        <x-input type="number" wire:model.defer="product.fabrication_cost" class="w-full" />
                        <x-input-error for="product.fabrication_cost" />
                    </div>
                    <div class="mb-2 md:mr-2 md:mb-0 w-full">
                        <x-label value="Fecha a Finalizar" class="font-bold" />
                        <x-input type="number" wire:model.defer="product.precio" class="w-full" />
                        <x-input-error for="product.precio" />
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('isOpen',false)" class="mx-2">Cancelar</x-secondary-button>
            <!-- <x-button wire:click="store" wire:loading.remove wire:target="store">Registrar</x-button> -->
            <x-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store"
                class="disabled:opacity-25">
                Registrar
            </x-button>
            <!-- <span wire:loading wire:target="store">Cargando...</span> -->
        </x-slot>

    </x-dialog-modal>
    @push('js')
    @endpush

</div>
