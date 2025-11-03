<x-app-layout>
    <x-slot name="header">
        Detalle de Personal de Control: {{ $personal_control->nombre_apellido }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">
                    Información del Personal
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 dark:text-gray-300">

                    <div>
                        <span class="font-bold">ID:</span>
                        <p>{{ $personal_control->id }}</p>
                    </div>

                    <div>
                        <span class="font-bold">Nombre y Apellido:</span>
                        <p>{{ $personal_control->nombre_apellido ?? '—' }}</p>
                    </div>

                    <div>
                        <span class="font-bold">DNI:</span>
                        <p>{{ $personal_control->dni ?? '—' }}</p>
                    </div>

                    <div>
                        <span class="font-bold">Rol:</span>
                        <p>{{ $personal_control->rol->nombre ?? '—' }}</p>
                    </div>

                    <div>
                        <span class="font-bold">Fecha de Creación:</span>
                        <p>{{ $personal_control->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <span class="font-bold">Última Actualización:</span>
                        <p>{{ $personal_control->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('personalcontrol.index') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        Volver
                    </a>

                    <a href="{{ route('personalcontrol.edit', $personal_control->id) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md">
                        Editar
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
