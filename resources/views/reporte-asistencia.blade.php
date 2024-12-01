<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reporte Asistencia') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Generar Reporte</h3>
                    <!-- Formulario de filtros -->
                    <form method="POST" action="{{ route('generar.reporte') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="idEmpleado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Buscar Empleado</label>
                                <input type="number" name="idEmpleado" id="idEmpleado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div>
                                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha Inicio</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div>
                                <label for="fecha_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha Fin</label>
                                <input type="date" name="fecha_fin" id="fecha_fin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 border border-blue-700">
                                Generar Reporte
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

