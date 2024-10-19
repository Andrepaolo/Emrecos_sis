<div class="py-0">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="dark:bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg px-3 py-2 mb-2">
            <h1 class="mt-2 text-center text-2xl font-bold text-white">¡Menú Productos!</h1>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <!-- Botón de Crear Nuevo Producto -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center p-2 rounded-md flex-1">
                    <label class="w-full relative text-gray-400 focus-within:text-gray-600 block">
                        <svg class="pointer-events-none w-8 h-8 absolute top-1/2 transform -translate-y-1/2 left-3" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <x-input type="text" wire:model="search" class="w-full block pl-14" placeholder="Buscar producto"/>
                    </label>
                </div>
                <div class="lg:ml-40 ml-10">
                    <button wire:click="create()" class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                        Nuevo
                    </button>
                    @if($isOpen)
                        @include('livewire.ad-product')
                    @endif
                </div>
            </div>

            <!-- Lista de Productos -->
            <h1 class="mt-4 text-lg font-semibold">Lista de Productos</h1>
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200 table-auto">
                    <thead class="bg-indigo-500 text-white">
                        <tr class="text-left text-xs font-bold uppercase">
                            <td wire:click="order('id')" class="px-6 py-3 cursor-pointer">ID</td>
                            <td wire:click="order('name')" class="px-6 py-3 cursor-pointer">Nombre del Producto</td>
                            <td wire:click="order('description')" class="px-6 py-3 cursor-pointer">Descripción</td>
                            <td wire:click="order('fabrication_cost')" class="px-6 py-3 cursor-pointer">Costo de Fabricación</td>
                            <td wire:click="order('precio')" class="px-6 py-3 cursor-pointer">Precio a vender</td>
                            <td class="px-6 py-3">Opciones</td>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($products as $item)
                            <tr class="text-sm font-medium text-gray-900" wire:key="product-{{ $item->id }}">
                                <td class="px-6 py-4">{{ $item->id }}</td>
                                <td class="px-6 py-4">{{ $item->name }}</td>
                                <td class="px-6 py-4">{{ $item->descripcion }}</td>
                                <td class="px-6 py-4">{{ $item->fabrication_cost }}</td>
                                <td class="px-6 py-4">{{ $item->precio }}</td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <x-button wire:click="edit({{ $item->id }})">
                                        <i class="fas fa-edit"></i> Editar
                                    </x-button>
                                    <x-danger-button wire:click="delete({{ $item->id }})">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(!$products->count())
                <p>No existe ningún registro coincidente</p>
            @endif

            @if($products->hasPages())
                <div class="px-6 py-3">
                    {{$products->links()}}
                </div>
            @endif
        </div>
    </div>

    <!-- SweetAlert para eliminar -->
    @push('js')
    <!-- Cargar SweetAlert2 desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('deleteItem', id => {
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

        // Escuchar evento para mostrar alertas de éxito
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
</div>

