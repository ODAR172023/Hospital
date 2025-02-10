<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Historial de Reportes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table id="logsTable" class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700" >
                            <tr>
                                <th>Usuario</th>
                                <th>Fecha de Generación</th>
                                <th>Empleado</th>
                                <th>Rango de Fechas</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800" style="text-align: center;">
                            @foreach ($logs as $log)
                                <tr>
                                    <td>{{ $log->nombre_usuario }}</td>
                                    <td>{{ $log->fecha_generacion }}</td>
                                    <td>{{ $log->nombre_empleado }}</td>
                                    <td>{{ $log->fecha_inicio }} - {{ $log->fecha_fin }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables Scripts -->
    <script>
        $(document).ready(function() {
            $('#logsTable').DataTable();
        });
    </script>
</x-app-layout>
