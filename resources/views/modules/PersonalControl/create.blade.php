<x-app-layout>
    <x-slot name="header">
        Crear Nuevo Personal de Control
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <form action="{{ route('personalcontrol.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Nombre y Apellido --}}
            <div>
                <label for="nombre_apellido">Nombre y Apellido</label>
                <input type="text" id="nombre_apellido" name="nombre_apellido" value="{{ old('nombre_apellido') }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                @error('nombre_apellido') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Legajo --}}
            <div>
                <label for="lejago_personal">Legajo</label>
                <input type="text" id="lejago_personal" name="lejago_personal" value="{{ old('lejago_personal') }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                @error('lejago_personal') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- DNI --}}
            <div>
                <label for="dni">DNI</label>
                <input type="number" id="dni" name="dni" value="{{ old('dni') }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                @error('dni') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Jerarquía --}}
            <div>
                <label for="jerarquia">Jerarquía</label>
                <input type="text" id="jerarquia" name="jerarquia" value="{{ old('jerarquia') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                @error('jerarquia') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Rol en Control --}}
            <div>
                <label for="rol_en_control">Rol en el Control</label>
                <input type="text" id="rol_en_control" name="rol_en_control" value="{{ old('rol_en_control') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                @error('rol_en_control') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Rol --}}
            <div>
                <label for="rol_id">Rol</label>
                <select id="rol_id" name="rol_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                    <option value="">Seleccione un Rol</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
                    @endforeach
                </select>
                @error('rol_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Fecha, Hora Inicio, Hora Fin, Lugar, Ruta --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="fecha_control">Fecha del Control</label>
                    <input type="date" id="fecha_control" name="fecha_control" value="{{ old('fecha_control') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('fecha_control') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="hora_inicio">Hora de Inicio</label>
                    <input type="time" id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('hora_inicio') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="hora_fin">Hora de Fin</label>
                    <input type="time" id="hora_fin" name="hora_fin" value="{{ old('hora_fin') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('hora_fin') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="lugar">Lugar</label>
                    <input type="text" id="lugar" name="lugar" value="{{ old('lugar') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('lugar') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="ruta">Ruta / Camino</label>
                    <input type="text" id="ruta" name="ruta" value="{{ old('ruta') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('ruta') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('personalcontrol.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Guardar Personal</button>
            </div>
        </form>
    </div>
</x-app-layout>