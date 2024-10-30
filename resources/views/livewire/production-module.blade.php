<div class="p-6 bg-gray-50 min-h-screen">
    <div class="mb-6">
        <div class="flex items-center bg-white rounded-lg shadow-sm p-3">
            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
                type="text"
                placeholder="Search products..."
                class="w-full outline-none"
                wire:model.live="searchTerm"
                aria-label="Search products"
            >
        </div>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 cursor-pointer">
                        <div class="flex items-center">
                            Product Name
                            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 10l5-5 5 5M5 15l5-5 5 5"/>
                            </svg>
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Step</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Start Date</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">End Date</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Workers</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Documents</th>
                </tr>
            </thead>
            <tbody>
                @foreach($this->filteredData as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $item['id'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $item['productName'] }}</td>
                        <td class="px-6 py-4 text-sm">
                            <select
                                wire:model.live="productionData.{{ array_search($item, $this->productionData) }}.step"
                                class="border rounded p-1 w-full"
                                aria-label="Select step"
                            >
                                <option value="soldar">Soldar</option>
                                <option value="pintar">Pintar</option>
                                <option value="cortar lamina">Cortar Lamina</option>
                                <option value="otros">otros</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <select
                                wire:model.live="productionData.{{ array_search($item, $this->productionData) }}.status"
                                class="border rounded p-1 w-full"
                                aria-label="Select status"
                            >
                                <option value="Iniciado">Iniciado</option>
                                <option value="En Proceso">En Proceso</option>
                                <option value="Finalizado">Finalizado</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $item['startDate'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $item['endDate'] }}</td>
                        <td class="px-6 py-4 text-sm">
                            <select
                                wire:model.live="productionData.{{ array_search($item, $this->productionData) }}.workers"
                                class="border rounded p-1 w-full"
                                multiple
                                aria-label="Select workers"
                            >
                                @foreach($availableWorkers as $worker)
                                    <option value="{{ $worker }}">{{ $worker }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if($item['documents'])
                                <svg class="w-5 h-5 text-red-500 cursor-pointer hover:text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"/>
                                    <path d="M3 8a2 2 0 012-2h2.93a.25.25 0 01.25.25v1.5a.25.25 0 01-.25.25H5a.25.25 0 00-.25.25v6.5c0 .138.112.25.25.25h10a.25.25 0 00.25-.25v-6.5a.25.25 0 00-.25-.25h-2.93a.25.25 0 01-.25-.25v-1.5a.25.25 0 01.25-.25H15a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                                </svg>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
