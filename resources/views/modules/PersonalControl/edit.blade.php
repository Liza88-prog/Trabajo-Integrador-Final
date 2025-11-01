<x-app-layout>
    <x-slot name="header">
        Editar Personal de Control: {{ $personal_control->nombre_apellido }}
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 space-y-6">

        <form action="{{ route('personalcontrol.update', $personal_control->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Información básica --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nombre_apellido" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Nombre y Apellido
                    </label>
                    <input type="text" id="nombre_apellido" name="nombre_apellido"
                        value="{{ old('nombre_apellido', $personal_control->nombre_apellido) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        required>
                    @error('nombre_apellido')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="lejago_personal" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Legajo
                    </label>
                    <input type="text" id="lejago_personal" name="lejago_personal"
                        value="{{ old('lejago_personal', $personal_control->lejago_personal) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        required>
                    @error('lejago_personal')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="dni" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        DNI
                    </label>
                    <input type="number" id="dni" name="dni"
                        value="{{ old('dni', $personal_control->dni) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        required>
                    @error('dni')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="jerarquia" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Jerarquía
                    </label>
                    <input type="text" id="jerarquia" name="jerarquia"
                        value="{{ old('jerarquia', $personal_control->jerarquia) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('jerarquia')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Rol y función --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="rol_en_control" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Rol en el Control
                    </label>
                    <input type="text" id="rol_en_control" name="rol_en_control"
                        value="{{ old('rol_en_control', $personal_control->rol_en_control) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('rol_en_control')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rol_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Rol
                    </label>
                    <select id="rol_id" name="rol_id"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">Seleccione un Rol</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}" {{ old('rol_id', $personal_control->rol_id) == $rol->id ? 'selected' : '' }}>
                                {{ $rol->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('rol_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Fecha, hora y lugar --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="fecha_control" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Fecha del Control
                    </label>
                    <input type="date" id="fecha_control" name="fecha_control"
                        value="{{ old('fecha_control', $personal_control->fecha_control) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('fecha_control')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="hora_inicio" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Hora de Inicio
                    </label>
                    <input type="time" id="hora_inicio" name="hora_inicio"
                        value="{{ old('hora_inicio', $personal_control->hora_inicio) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('hora_inicio')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="hora_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Hora de Fin
                    </label>
                    <input type="time" id="hora_fin" name="hora_fin"
                        value="{{ old('hora_fin', $personal_control->hora_fin) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('hora_fin')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Lugar y ruta --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="lugar" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Lugar del Control
                    </label>
                    <input type="text" id="lugar" name="lugar"
                        value="{{ old('lugar', $personal_control->lugar) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('lugar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="ruta" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Ruta / Camino
                    </label>
                    <input type="text" id="ruta" name="ruta"
                        value="{{ old('ruta', $personal_control->ruta) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('ruta')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('personalcontrol.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Actualizar Personal
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
