<div class="py-0">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg px-6 py-4 mb-4">
            <h1 class="text-center text-3xl font-extrabold text-white">¡Menú de Material!</h1>
        </div>
        <div class="bg-white shadow-xl sm:rounded-lg px-6 py-4">
            <!-- Barra de búsqueda -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center p-3 rounded-lg bg-gray-100 flex-1">
                    <label class="w-full relative text-gray-500 focus-within:text-gray-800 block">
                        <svg class="pointer-events-none w-6 h-6 absolute top-1/2 transform -translate-y-1/2 left-3" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input wire:model.live="search" type="text" class="w-full block pl-14" placeholder="Buscar producto" />
                    </label>
                </div>

                <!-- Botón para registrar nuevo ingreso -->
                <div>
                    <button wire:click="create()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md font-bold tracking-wide cursor-pointer transition duration-300 ease-in-out">
                        + Nuevo Material
                    </button>
                    @if($isOpen)
                        @include('livewire.add.add-material')
                    @endif
                </div>
            </div>

            <!-- Lista de Productos -->
            <h2 class="text-xl font-semibold mb-4">Lista de Materiales</h2>
            <div class="flex justify-between mb-4">
                <button wire:click="sortAsc" class="dark:bg-gray-600 text-white px-4 py-2 rounded">Ordenar Ascendente</button>
                <button wire:click="sortDesc" class="dark:bg-gray-600 text-white px-4 py-2 rounded">Ordenar Descendente</button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                    <thead class="dark:bg-gray-800 text-white">
                        <tr class="text-left text-sm font-semibold uppercase">
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Nombre del Material</th>
                            <th class="px-6 py-3">Unidad de Medida</th>
                            <th class="px-6 py-3">Precio Promedio de Unidad</th>
                            <th class="px-6 py-3">Cantidad</th>
                            <th class="px-6 py-3 text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        @foreach ($materials as $item)
                            <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                                <td class="px-6 py-4">{{ $item->id }}</td>
                                <td class="px-6 py-4">{{ $item->name }}</td>
                                <td class="px-6 py-4">{{ $item->unit->unidadMedida }}</td>
                                <td class="px-6 py-4">{{ $item->precio_unidad }}</td>
                                <td class="px-6 py-4">{{ $item->stock }}</td>
                                <td class="px-6 py-4 flex justify-center space-x-2">
                                    <!-- Botón para ingresar material -->
                                    <!-- Botón para ingreso -->
                                    <button wire:click="openIngresoModal({{ $item->id }})" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded-lg shadow-md transition duration-300 ease-in-out">
                                        Ingresar
                                    </button>

                                    <!-- Botón para egreso -->
                                    <button wire:click="openEgresoModal({{ $item->id }})" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-lg shadow-md transition duration-300 ease-in-out">
                                        Egresar
                                    </button>

                                    <!-- Modal de Ingreso -->
                                    @if($showIngresoModal)
                                        <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                                            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                                                <h2 class="text-lg font-bold mb-4">Registrar Ingreso de Material</h2>
                                                <label class="block mb-2">Cantidad a Ingresar:</label>
                                                <input type="number" wire:model="quantity" class="w-full p-2 border border-gray-300 rounded mb-4" min="1">
                                                <div class="flex justify-end space-x-4">
                                                    <button wire:click="registerIngreso" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Registrar</button>
                                                    <button wire:click="closeModal" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Modal de Egreso -->
                                    @if($showEgresoModal)
                                        <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                                            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                                                <h2 class="text-lg font-bold mb-4">Registrar Egreso de Material</h2>
                                                <label class="block mb-2">Cantidad a Egresar:</label>
                                                <input type="number" wire:model="quantity" class="w-full p-2 border border-gray-300 rounded mb-4" min="1">
                                                <div class="flex justify-end space-x-4">
                                                    <button wire:click="registerEgreso" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Registrar</button>
                                                    <button wire:click="closeModal" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                    <!-- Botón para editar material -->
                                    <button wire:click="edit({{ $item->id }})" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded-lg shadow-md transition duration-300 ease-in-out">
                                        Editar
                                    </button>
                                    <!-- Botón para eliminar material -->
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
            @if(!$materials->count())
                <p class="text-center text-gray-600 py-4">No existe ningún registro coincidente</p>
            @endif

            <!-- Paginación -->
            @if($materials->hasPages())
                <div class="py-3">
                    {{$materials->links()}}
                </div>
            @endif
        </div>
    </div>
</div>
