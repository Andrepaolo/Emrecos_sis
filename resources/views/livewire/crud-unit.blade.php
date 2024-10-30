<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-black to-gray-900 overflow-hidden shadow-xl sm:rounded-lg px-6 py-8 mb-6">
            <h1 class="text-center text-3xl font-extrabold text-white">¡Unidades de Medida!</h1>
            <p class="text-center text-gray-300 mt-2">Gestiona tus unidades de medida de manera eficiente</p>
        </div>

        <!-- Main Content Section -->
        <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg">
            <!-- Search and Create Section -->
            <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="relative w-full sm:max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input
                            wire:model.live="search"
                            type="text"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition duration-150 ease-in-out"
                            placeholder="Buscar unidad de medida..."
                        >
                        <div wire:loading wire:target="search" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-primary-600"></div>
                        </div>
                    </div>
                    <button wire:click="create()" class="bg-black text-white px-4 py-2 rounded-md font-semibold tracking-wide cursor-pointer shadow-lg hover:bg-gray-800 transition ease-in-out duration-150">
                        Nuevo Unidad
                    </button>
                </div>
            </div>

            <!-- Table Section -->
            <div class="px-6 py-4">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4 sm:mb-0">Lista de Unidades</h2>
                    <div class="flex space-x-2">
                        <button
                            wire:click="sortAsc"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-out"
                        >
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                            </svg>
                            Ascendente
                        </button>
                        <button
                            wire:click="sortDesc"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-out"
                        >
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4 4m0 0l4-4m-4 4v-12" />
                            </svg>
                            Descendente
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Unidad de Medida</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($units as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $item->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $item->unidadMedida }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button
                                                wire:click="edit({{ $item->id }})"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 text-white text-sm font-medium rounded-lg transition duration-150 ease-in-out"
                                            >
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Editar
                                            </button>
                                            <button
                                                wire:click="delete({{ $item->id }})"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 focus:bg-red-700 text-white text-sm font-medium rounded-lg transition duration-150 ease-in-out"
                                            >
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center py-8">
                                            <svg class="w-12 h-12 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-lg font-medium">No existe ningún registro coincidente</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Intenta con otros términos de búsqueda</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($units->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        {{ $units->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal for Create/Edit -->
    @if($isOpen)
        @include('livewire.add-unit')
    @endif
</div>
