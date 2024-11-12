<div class="py-0 bg-gray-100 min-h-screen">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 pt-8">

        <!-- Indicador de carga
        <div wire:loading.delay class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
        </div> -->

        <!-- Botones de navegación -->
        <div class="flex space-x-4 mb-6">
            <button wire:click="setView('products')" wire:loading.attr="disabled" class="px-6 py-2 rounded-lg shadow-lg transition duration-300 {{ $view === 'products' ? 'bg-gray-800 text-white' : 'bg-white text-gray-700 hover:bg-blue-100' }}">
                Productos
            </button>
            <button wire:click="setView('units')" wire:loading.attr="disabled" class="px-6 py-2 rounded-lg shadow-lg transition duration-300 {{ $view === 'units' ? 'bg-gray-800 text-white' : 'bg-white text-gray-700 hover:bg-blue-100' }}">
                Unidades de Medida
            </button>
            
        </div>

        <!-- Contenido dinámico -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            @if ($view === 'products')
                @livewire('prueba-pr')
            @elseif ($view === 'units')
                @livewire('crud-unit')
            @endif
        </div>
    </div>
</div>
