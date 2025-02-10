<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administrar Empleados') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Formulario de filtros -->
                    <!-- Formulario de filtros -->
                    <form method="GET" action="{{ route('adminempleados') }}" class="space-y-6">
                        <div class="flex items-end gap-4">
                            <!-- Campo ID de Empleado -->
                            <div class="flex-1">
                                <label for="idEmpleado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID de Empleado</label>
                                <input type="text" name="idEmpleado" id="idEmpleado" value="{{ request('idEmpleado') }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            </div>

                            <!-- Campo Nombre de Empleado -->
                            <div class="flex-1">
                                <label for="nombreUsuario" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de Empleado</label>
                                <input type="text" name="nombreUsuario" id="nombreUsuario" value="{{ request('nombreUsuario') }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            </div>

                            <!-- Botón Buscar -->
                            <div style="margin-top: 18px;">
                                <button type="submit" class="flex items-center gap-2 px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                                    </svg>
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <br>
                    <!-- Tabla con los datos -->
                    <div class="overflow-x-auto mt-4">
                    <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-200">ID de Empleado</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-200">Nombre de Empleado</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-200">Departamento</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-200">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800" style="text-align: center;">
                            @foreach ($registros as $registro)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-300">{{ $registro->IdEmpleado }}</td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-300">{{ $registro->NombreUsuario }}</td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-300">{{ $registro->Departamento }}</td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-300">
                                    <form method="POST" action="{{ route('actualizar.departamento') }}">
                                            @csrf
                                            <!-- Campo oculto para el ID del empleado -->
                                            <input type="hidden" name="idEmpleado" value="{{ $registro->IdEmpleado }}">
                                            <!-- Select de departamentos -->
                                            <div class="flex items-center space-x-2">
                                                <select name="nuevoDepartamento" class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
                                                    <option value="" Selected>Seleccione</option>
                                                    <option value="ADMINISTRACIÓN">ADMINISTRACIÓN</option>
                                                    <option value="SECRETARIA">SECRETARIA</option>
                                                    <option value="UGI">UGI</option>
                                                    <option value="ADMISIÓN Y ARCHIVO">ADMISIÓN Y ARCHIVO</option>
                                                    <option value="ALMACEN">ALMACEN</option>
                                                    <option value="ANESTESIA">ANESTESIA</option>
                                                    <option value="ASEO">ASEO</option>
                                                    <option value="BIENES NACIONALES">BIENES NACIONALES</option>
                                                    <option value="COCINA">COCINA</option>
                                                    <option value="ENFERMERIA">ENFERMERIA</option>
                                                    <option value="FARMACIA">FARMACIA</option>
                                                    <option value="GESTIÓN CLINICA">GESTIÓN CLINICA</option>
                                                    <option value="INSTRUMENTISTA">INSTRUMENTISTA</option>
                                                    <option value="LABORATORIO">LABORATORIO</option>
                                                    <option value="LAVANDERIA">LAVANDERIA</option>
                                                    <option value="MANTENIMIENTO">MANTENIMIENTO</option>
                                                    <option value="ODONTOLOGIA">ODONTOLOGIA</option>
                                                    <option value="PLANIFICACIÓN">PLANIFICACIÓN</option>
                                                    <option value="RECEPTORIA DE FONDOS">RECEPTORIA DE FONDOS</option>
                                                    <option value="RRHH">RRHH</option>
                                                    <option value="SIN DEFINIR">SASTRERÍA</option>
                                                    <option value="SIN DEFINIR">SIN DEFINIR</option>
                                                    <option value="TRANSPORTE">TRANSPORTE</option>
                                                    <option value="UAU">UAU</option>
                                                    <option value="VIGILANCIA">VIGILANCIA</option>
                                                </select>

                                                <!-- Botón de asignar -->
                                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 border border-blue-700" style="margin-left: 10px;">
                                                    Asignar
                                                </button>
                                            </div>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $registros->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    function openModal(idEmpleado, nombreEmpleado, departamentoActual) {
        // Asignar valores al modal
        //document.getElementById('idEmpleado').value = empleadoId; // Asignar el ID al campo oculto
        document.getElementById('idEmpleado').value = idEmpleado;
        document.getElementById('IdEmpleados').innerText = idEmpleado; // Mostrar el ID en el modal
        document.getElementById('nombreEmpleado').innerText = nombreEmpleado; // Mostrar el nombre en el modal
        document.getElementById('departamentoActual').innerText = departamentoActual; // Mostrar el departamento actual en el modal

        // Mostrar el modal
        document.getElementById('modal-departamento').classList.remove('hidden');
    }

    function closeModal() {
        // Ocultar el modal
        document.getElementById('modal-departamento').classList.add('hidden');
    }
</script>
