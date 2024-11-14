<!-- resources/views/product/product-details.blade.php -->
<div class="py-0">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg px-6 py-4 mb-4">
            <h1 class="text-center text-3xl font-extrabold text-white">Detalles del Producto: {{ $product->name }}</h1>
        </div>

        <div class="bg-white shadow-xl sm:rounded-lg px-6 py-4">
            <h2 class="text-xl font-semibold mb-4">Pasos del Producto</h2>
            @foreach ($product->steps as $step)
                <div class="mb-6 p-4 border rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">{{ $step->name }}</h3>
                    <p>{{ $step->descripcion }}</p>
                    <p><strong>Costo:</strong> ${{ $step->cost }}</p>

                    <!-- Mostrar detalles del producto relacionado a este paso -->
                    <h4 class="font-medium mt-4">Materiales usados en este paso:</h4>
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-2">
                        <thead class="bg-gray-800 text-white">
                            <tr class="text-left text-sm font-semibold uppercase">
                                <th class="px-6 py-3">ID Material</th>
                                <th class="px-6 py-3">Material</th>
                                <th class="px-6 py-3">Cantidad</th>
                                <th class="px-6 py-3">Precio Unitario</th>
                                <th class="px-6 py-3">Total Material</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            @foreach ($step->productDetails as $detail)
                                <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                                    <td class="px-6 py-4">{{ $detail->material_id }}</td>
                                    <td class="px-6 py-4">{{ $detail->material->name }}</td> <!-- Asumiendo que tienes una relación material en ProductDetail -->
                                    <td class="px-6 py-4">{{ $detail->cantidad }}</td>
                                    <td class="px-6 py-4">${{ $detail->preciounit }}</td>
                                    <td class="px-6 py-4">${{ $detail->total_material }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</div>
