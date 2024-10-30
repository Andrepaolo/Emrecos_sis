<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-white rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    <img src="{{ asset('incon/pen.png') }}" alt="Editar" style="width: 25px; height: 25px; margin-right: 4px;">
    {{ $slot }}
</button>
