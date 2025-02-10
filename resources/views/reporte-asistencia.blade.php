<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <!-- DataTables JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reporte Asistencia') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4" style="text-align: center;">Generar Reporte</h3>
                    <!-- Formulario de filtros -->
                        <form method="POST" action="{{ route('generar.reporte') }}" target="_blank">
                            @csrf
                            <div class="mb-4 flex items-center justify-between">
                                <!-- Línea 1: Selector de Empleado -->
                                <div style="width: 85%; margin-right: 15px;">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <label for="idEmpleado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Seleccionar Empleado
                                        </label>
                                    </div>

                                    <div class="space-y-2">
                                    <select name="idEmpleado" id="idEmpleado"
                                        class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-900 dark:text-gray-100"
                                        required>
                                        <option value="" disabled selected>Buscar empleado...</option>
                                        @foreach ($empleados as $empleado)
                                            <option value="{{ $empleado->IdEmpleado }}" class="dark:bg-gray-800 dark:text-gray-300">
                                            {{ $empleado->IdEmpleado }} - {{ $empleado->NombreUsuario }} ({{ $empleado->Departamento ?? 'Sin Departamento' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <!-- Línea 2: Fechas en misma línea -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" style="margin-top:15px;">
                                        <div class="space-y-2">
                                            <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Fecha Inicio
                                            </label>
                                            <input type="date" name="fecha_inicio" id="fecha_inicio" 
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                                                required>
                                        </div>

                                        <div class="space-y-2">
                                            <label for="fecha_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Fecha Fin
                                            </label>
                                            <input type="date" name="fecha_fin" id="fecha_fin" 
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                <!-- Línea 3: Botón Centrado -->
                                    <button type="submit" 
                                    class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                                        <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                        </svg>

                                        Generar Reporte
                                    </button>
                                </div>
                            </div>    
                        </form>
                </div> 
            </div> 
                        <br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mt-8" style="text-align: center; margin-top: 10px;">Registros del Día</h3>
                    <br>
                    <!-- Formulario de búsqueda -->
                    <form method="GET" action="{{ route('reporte.asistencia') }}" class="mb-4 flex items-center justify-between">
                    <!-- Sección izquierda: Buscador y botón Buscar -->
                    <div class="flex items-center space-x-4">
                        <input type="text" name="search" placeholder="Buscar por nombre..." value="{{ $search ?? '' }}" 
                            class="px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            <button type="submit" 
                                class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                style="margin-left: 15px;">
                                
                                <!-- Icono -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                                </svg>

                                <!-- Texto -->
                                Buscar
                            </button>

                    </div>

                    <!-- Sección derecha: Botón Exportar PDF -->
                    <div>
                        <a href="{{ route('export-pdf') }}" 
                            class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M9.75 6.75h-3a3 3 0 0 0-3 3v7.5a3 3 0 0 0 3 3h7.5a3 3 0 0 0 3-3v-7.5a3 3 0 0 0-3-3h-3V1.5a.75.75 0 0 0-1.5 0v5.25Zm0 0h1.5v5.69l1.72-1.72a.75.75 0 1 1 1.06 1.06l-3 3a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l1.72 1.72V6.75Z" clip-rule="evenodd" />
                            <path d="M7.151 21.75a2.999 2.999 0 0 0 2.599 1.5h7.5a3 3 0 0 0 3-3v-7.5c0-1.11-.603-2.08-1.5-2.599v7.099a4.5 4.5 0 0 1-4.5 4.5H7.151Z" />
                            </svg>
                            Exportar Tabla
                        </a>
                    </div>
                    </form>

                       <!-- Tabla de registros del día -->
                        
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
                                            <td colspan="5" class="px-4 py-2 text-center text-sm text-gray-500 dark:text-gray-400">No hay registros para mostrar.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div> 

                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $registrosHoy->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inicializar Select2
        $('#idEmpleado').select2({
            theme: "classic", // Combina mejor con Tailwind
            width: '100%',
            placeholder: "Seleccionar empleado...",
            allowClear: true
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#tablaRegistros').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' // Traducción al español
            },
            order: [[0, 'asc']] // Ordenar inicialmente por la primera columna
        });
    });
</script>
