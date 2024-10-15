<!-- resources/views/livewire/create-product.blade.php -->

<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Fondo oscuro -->
        <div class="fixed inset-0 transition-opacity" wire:click="closeModal">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- Contenedor Modal -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <!-- Encabezado del modal -->
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <!-- Ícono -->
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <!-- Título -->
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ isset($product->id) ? 'Editar Producto' : 'Crear Nuevo Producto' }}
                        </h3>
                        <!-- Formulario -->
                        <div class="mt-2">
                            <form>
                                <!-- Nombre del Producto -->
                                <div class="mb-4">
                                    <label value="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre del Producto:</label>
                                    <input type="text" wire:model="product.name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    @error('product.name') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                                <!-- Descripción -->
                                <div class="mb-4">
                                    <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción:</label>
                                    <textarea wire:model="product.descripcion" id="descripcion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                                    @error('product.descripcion') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                                <!-- Costo de Fabricación -->
                                <div class="mb-4">
                                    <label for="fabrication_cost" class="block text-gray-700 text-sm font-bold mb-2">Costo de Fabricación:</label>
                                    <input type="number" wire:model="product.fabrication_cost" id="fabrication_cost" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    @error('product.fabrication_cost') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                                <!-- Precio -->
                                <div class="mb-4">
                                    <label for="precio" class="block text-gray-700 text-sm font-bold mb-2">Precio:</label>
                                    <input type="number" wire:model="product.precio" id="precio" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    @error('product.precio') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de Guardar y Cancelar -->
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <!-- Botón Guardar -->
                <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-white font-medium hover:bg-indigo-500 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                    Guardar
                </button>
                <!-- Botón Cancelar -->
                <button wire:click="closeModal" type="button" class="mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-gray-700 font-medium hover:text-gray-500 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
