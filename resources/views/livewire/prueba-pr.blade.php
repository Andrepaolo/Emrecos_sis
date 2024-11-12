<div class="py-6 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-lg shadow-xl mb-6">
            <h1 class="text-center text-3xl font-extrabold text-white py-6">Menú de Productos</h1>
        </div>

        <div class="bg-white shadow-xl rounded-lg p-6">
            <!-- Search and Create New Product -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6 space-y-4 sm:space-y-0">
                <div class="w-full sm:w-1/2 relative">
                    <input wire:model.live="search" type="text" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="Buscar producto">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <button wire:click="create()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow-md font-bold tracking-wide transition duration-300 ease-in-out flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Nuevo Producto
                </button>
            </div>

            @if($isOpen)
                @include('livewire.add.ad-product')
            @endif

            <!-- Product List -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Lista de Productos</h2>
                <div class="flex justify-between mb-4">
                    <button wire:click="sortAsc" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition duration-300 ease-in-out flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                        </svg>
                        Ordenar Ascendente
                    </button>
                    <button wire:click="sortDesc" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition duration-300 ease-in-out flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                        </svg>
                        Ordenar Descendente
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                        <tr class="text-left">
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">ID</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Nombre del Producto</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Descripción</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Costo de Fabricación</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Precio</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $item)
                            <tr class="hover:bg-gray-100 transition-colors duration-200">
                                <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $item->id }}</td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $item->name }}</td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $item->descripcion }}</td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $item->fabrication_cost }}</td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $item->precio }}</td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-4">
                                    <div class="flex justify-center space-x-4">
                                        <button wire:click="edit({{ $item->id }})" class="text-blue-500 hover:text-blue-600 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>
                                        <button wire:click="delete({{ $item->id }})" class="text-red-500 hover:text-red-600 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border-dashed border-t border-gray-200 px-6 py-4 text-center text-gray-500">No existe ningún registro coincidente</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Livewire.on('delete', id => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('delete', id);
                Swal.fire(
                    '¡Eliminado!',
                    'El producto ha sido eliminado.',
                    'success'
                );
            }
        });
    });

    Livewire.on('alert', event => {
        if (event && event.title) {
            Swal.fire({
                title: '¡Éxito!',
                text: event.title,
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        } else {
            console.error('El mensaje de la alerta no está definido.');
        }
    });
</script>
@endpush
