<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel Principal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 text-center">
                <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-100">
                    Bienvenido al Panel de Control
                </h3>

                <a href="{{ route('PersonalControl.index') }}"
                   class="inline-block px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                   Ir al Panel de Personal
                </a>
            </div>
        </div>
    </div>
</x-app-layout>