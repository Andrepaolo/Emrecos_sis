<div class="py-0">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg px-6 py-4 mb-4">
            <h1 class="mt-2 text-left text-2xl font-bold text-black">Productos</h1>
        </div>
        <div class="bg-white shadow-xl sm:rounded-lg px-6 py-4">
            <!-- Botón de Crear Nuevo Producto -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center p-3 rounded-lg bg-gray-100 flex-1">
                    <label class="w-full relative text-gray-500 focus-within:text-gray-800 block">
                        <svg class="pointer-events-none w-6 h-6 absolute top-1/2 transform -translate-y-1/2 left-3" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input wire:model.live="search" type="text"  class="w-full block pl-14" placeholder="Buscar producto" />
                        <!-- msotrar loading
                        <div wire:loading wire:target="search" class="text-gray-500">
                            Buscando...
                        </div>-->
                    </label>

                </div>
                <div class="lg:ml-40 ml-10">
                    <button wire:click="create()" class="bg-black text-white px-4 py-2 rounded-md font-semibold tracking-wide cursor-pointer shadow-lg hover:bg-gray-800 transition ease-in-out duration-150">
                        Nuevo Producto
                    </button>
                    @if($isOpen)
                        @include('livewire.ad-product')
                    @endif
                </div>
            </div>

            <!-- Lista de Productos -->
            <h2 class="text-xl font-semibold mb-4">Lista de Productos</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                    <thead class="bg-black text-white divide-x divide-gray-200">
                        <tr class="text-left text-xs font-bold uppercase">
                            <td class="px-6 py-3">ID</td>
                            <td class="px-6 py-3">Nombre del Producto</td>
                            <td class="px-6 py-3">Descripción</td>
                            <td class="px-6 py-3">Costo de Fabricación</td>
                            <td class="px-6 py-3">Precio a vender</td>
                            <td class="px-6 py-3 text-center">Opciones</td>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        @foreach ($products as $item)
                            <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                                <td class="px-6 py-4">{{ $item->id }}</td>
                                <td class="px-6 py-4">{{ $item->name }}</td>
                                <td class="px-6 py-4">{{ $item->descripcion }}</td>
                                <td class="px-6 py-4">{{ $item->fabrication_cost }}</td>
                                <td class="px-6 py-4">{{ $item->precio }}</td>
                                <td class="px-6 py-4 flex justify-center space-x-2">
                                    <x-button wire:click="edit({{ $item->id }})">
                                    </x-button>
                                    <x-danger-button wire:click="delete({{ $item->id }})"> </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mensaje de No Resultados -->
            @if(!$products->count())
                <p class="text-center text-gray-600 py-4">No existe ningún registro coincidente</p>
            @endif

            <!-- Paginación -->
            @if($products->hasPages())
                <div class="py-3">
                    {{$products->links()}}
                </div>
            @endif
        </div>
    </div>
</div>
