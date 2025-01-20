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
                    <form method="POST" action="{{ route('generar.reporte') }}" class="space-y-6" target="_blank">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="idEmpleado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Buscar Empleado
                                </label>

                                <!-- Select con funcionalidad de búsqueda -->
                                <select name="idEmpleado" id="idEmpleado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                                    <option value="" disabled selected>Seleccione o busque un empleado...</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->IdEmpleado }}">
                                            {{ $empleado->NombreUsuario }} ({{ $empleado->Departamento ?? 'Sin Departamento' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Fecha Inicio
                                </label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                            </div>

                            <div>
                                <label for="fecha_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Fecha Fin
                                </label>
                                <input type="date" name="fecha_fin" id="fecha_fin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 border border-blue-700">
                                    Generar Reporte
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Tabla de registros del día -->
                    <h3 class="text-lg font-medium mt-8">Registros del Día</h3>
                    <br>
                    <br>
                     <!-- Formulario de búsqueda -->
                     <form method="GET" action="{{ route('reporte.asistencia') }}" class="mb-4 flex items-center justify-between">
                        <!-- Sección izquierda: Buscador y botón Buscar -->
                        <div class="flex items-center space-x-4">
                            <input type="text" name="search" placeholder="Buscar por nombre..." value="{{ $search ?? '' }}" 
                                class="px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            <button type="submit" 
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                Buscar
                            </button>
                        </div>
                        <!-- Sección derecha: Botón Exportar PDF -->
                        <div>
                            <a href="{{ route('export-pdf') }}" 
                                class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                                Exportar Tabla
                            </a>
                        </div>
                    </form>

                    @if ($registrosHoy)
                        <div class="overflow-x-auto mt-4">
                            <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-700">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-left text-sm font-medium text-gray-800 dark:text-gray-200">ID</th>
                                        <th class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-left text-sm font-medium text-gray-800 dark:text-gray-200">Nombre</th>
                                        <th class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-left text-sm font-medium text-gray-800 dark:text-gray-200">Departamento</th>
                                        <th class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-left text-sm font-medium text-gray-800 dark:text-gray-200">Fecha</th>
                                        <th class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-left text-sm font-medium text-gray-800 dark:text-gray-200">Hora Registro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($registrosHoy as $registro)
                                        <tr class="{{ $loop->odd ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }}">
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm text-gray-900 dark:text-gray-100">{{ $registro->ID }}</td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm text-gray-900 dark:text-gray-100">{{ $registro->Name }}</td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm text-gray-900 dark:text-gray-100">{{ $registro->Departamento ?? 'Sin Departamento' }}</td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm text-gray-900 dark:text-gray-100">{{ $registro->Fecha }}</td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm text-gray-900 dark:text-gray-100">{{ $registro->HoraRegistro }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-4 py-2 text-center text-sm text-gray-500 dark:text-gray-400">
                                                No hay registros para mostrar.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <div class="mt-4">
                            {{ $registrosHoy->links() }}
                        </div>
                    @else
                        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">No tienes permiso para ver los registros del día.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inicializar Select2
        $('#idEmpleado').select2({
            placeholder: "Seleccione o busque un empleado...",
            allowClear: true,  // Permitir limpiar la selección
            theme: "classic",  // Tema para combinar con el diseño
            width: '100%'      // Ajusta el ancho del select
        });
    });
</script>
