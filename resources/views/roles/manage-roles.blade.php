<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage User Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">User Roles and Permissions</h3>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('update-roles') }}">
                        @csrf
                        @method('PUT')

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worker</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="checkbox" name="roles[{{ $user->id }}][admin]" value="1" {{ $user->is_admin ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-blue-600">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="checkbox" name="roles[{{ $user->id }}][worker]" value="1" {{ $user->is_worker ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-blue-600">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <select name="permissions[{{ $user->id }}][]" multiple class="form-multiselect block w-full mt-1">
                                                <option value="view_materials" {{ $user->can('view_materials') ? 'selected' : '' }}>View Materials</option>
                                                <option value="edit_products" {{ $user->can('edit_products') ? 'selected' : '' }}>Edit Products</option>
                                                <option value="manage_units" {{ $user->can('manage_units') ? 'selected' : '' }}>Manage Units</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            <x-button type="submit">
                                {{ __('Update Roles and Permissions') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
