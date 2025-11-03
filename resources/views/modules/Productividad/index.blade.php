<x-app-layout>
    {{-- 🔹 Header con navegación --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                Gestión de Productividad
            </h2>

            {{-- 🔹 Navegadores --}}
            <nav class="flex space-x-2">
                <a href="{{ route('conductores.index') }}"
                   class="text-white bg-black px-3 py-1 rounded font-medium text-sm hover:bg-gray-800">
                    Ir a Conductores
                </a>
                <a href="{{ route('vehiculo.index') }}"
                   class="text-white bg-black px-3 py-1 rounded font-medium text-sm hover:bg-gray-800">
                    Ir a Vehículos
                </a>
                <a href="{{ route('novedades.index') }}"
                   class="text-white bg-black px-3 py-1 rounded font-medium text-sm hover:bg-gray-800">
                    Ir a Novedades
                </a>
            </nav>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ✅ Mensaje de éxito --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <strong class="font-bold">¡Éxito!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- 🔹 Botón Crear --}}
            <a href="{{ route('productividades.create') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md 
                      font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 mb-6">
                Crear Productividad
            </a>

            {{-- 📊 Tabla --}}
            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Personal Control</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total Conductores</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total Vehículos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total Acompañantes</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($productividades as $productividad)
                            <tr>
                                <td class="px-6 py-4">{{ $productividad->id }}</td>
                                <td class="px-6 py-4">
                                    {{ $productividad->personalControl->nombre_apellido ?? '—' }}
                                </td>
                                <td class="px-6 py-4">{{ $productividad->fecha }}</td>
                                <td class="px-6 py-4">{{ $productividad->total_conductor ?? 0 }}</td>
                                <td class="px-6 py-4">{{ $productividad->total_vehiculos ?? 0 }}</td>
                                <td class="px-6 py-4">{{ $productividad->total_acompanante ?? 0 }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('productividades.show', $productividad->id) }}" class="text-green-600 hover:text-green-900">Ver</a>
                                    <a href="{{ route('productividades.edit', $productividad->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                    <form action="{{ route('productividades.destroy', $productividad->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar esta productividad?');">
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
