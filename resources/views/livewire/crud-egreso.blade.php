<div class="py-0">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg px-6 py-4 mb-4">
            <h1 class="text-center text-3xl font-extrabold text-white">¡Menú de Egreso!</h1>
        </div>


        <div class="bg-white shadow-xl sm:rounded-lg px-6 py-4">
            <!-- Botón de Crear Nuevo Producto -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center p-3 rounded-lg bg-gray-100 flex-1">
                    <label class="w-full relative text-gray-500 focus-within:text-gray-800 block">
                        <svg class="pointer-events-none w-6 h-6 absolute top-1/2 transform -translate-y-1/2 left-3" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input wire:model.live="search" type="text"  class="w-full block pl-14" placeholder="Buscar Egrsos" />
                        <!-- msotrar loading
                        <div wire:loading wire:target="search" class="text-gray-500">
                            Buscando...
                        </div>-->
                    </label>

                </div>

            </div>

            <!-- Lista de Productos -->
            <h2 class="text-xl font-semibold mb-4">Lista de Egresos</h2>
            <div class="flex justify-between mb-4">
                <button wire:click="sortAsc" class="bg-gray-800 text-white px-4 py-2 rounded">Ordenar Ascendente</button>
                <button wire:click="sortDesc" class="bg-gray-800 text-white px-4 py-2 rounded">Ordenar Descendente</button>
            </div>



            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                    <thead class="bg-gray-800 text-white">
                        <tr class="text-left text-sm font-semibold uppercase">
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Nombre del Material</th>
                            <th class="px-6 py-3">Unidad de medida</th>
                            <th class="px-6 py-3">Cantidad Restada</th>
                            <th class="px-6 py-3">Fecha</th>
                            <th class="px-6 py-3">Destino</th>
                            <th class="px-6 py-3 text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        @foreach ($egresos as $item)
                            <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                                <td class="px-6 py-4">{{ $item->id }}</td>
                                <td class="px-6 py-4">{{ $item->material->name }}</td>
                                <td class="px-6 py-4">{{ $item->material->unit->unidadMedida}}</td>
                                <td class="px-6 py-4">- {{ $item->quantity}}</td>
                                <td class="px-6 py-4">{{ $item->date }}</td>
                                <td class="px-6 py-4">{{ $item->destination }}</td>

                                <td class="px-6 py-4 flex justify-center space-x-2">
                                    <button wire:click="edit({{ $item->id }})" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded-lg shadow-md transition duration-300 ease-in-out">
                                        Editar
                                    </button>
                                    <button wire:click="delete({{ $item->id }})" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-lg shadow-md transition duration-300 ease-in-out">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mensaje de No Resultados -->
            @if(!$egresos->count())
                <p class="text-center text-gray-600 py-4">No existe ningún registro coincidente</p>
            @endif

            <!-- Paginación -->
            @if($egresos->hasPages())
                <div class="py-3">
                    {{$egresos->links()}}
                </div>
            @endif
        </div>
    </div>
</div>
