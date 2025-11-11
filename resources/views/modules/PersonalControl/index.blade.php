<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">Gestión de Personal de Control</h2>

            {{-- 🔹 Navegadores oscuro --}}
            <nav class="flex gap-2 bg-gray-900 text-white px-3 py-1 rounded-md shadow">
                <a href="{{ route('conductores.index') }}"
                   class="text-sm font-medium hover:underline">
                    Conductores
                </a>
            </nav>
        </div>
            
    
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensaje de éxito --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">¡Éxito!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Botón Crear --}}
            <a href="{{ route('personalcontrol.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 mb-6">
                Crear Nuevo Personal
            </a>

            {{-- Tabla de Personal --}}
            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre y Apellido</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">DNI</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Rol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($personalControls as $personal)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $personal->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $personal->nombre_apellido }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $personal->dni }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $personal->rol->nombre ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                <a href="{{ route('personalcontrol.show', $personal->id) }}" class="text-green-600 hover:text-green-900">Ver detalle</a>

                                    <a href="{{ route('personalcontrol.edit', $personal->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                    <form action="{{ route('personalcontrol.destroy', $personal->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este registro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>