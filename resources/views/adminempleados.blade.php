<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administrar Empleados') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Registro de Empleados</h3>
                    <!-- Formulario de filtros -->
                    <form method="GET" action="{{ route('adminempleados') }}" class="space-y-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="idEmpleado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID de Empleado</label>
                                <input type="text" name="idEmpleado" id="idEmpleado" value="{{ request('idEmpleado') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div>
                                <label for="nombreUsuario" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de Empleado</label>
                                <input type="text" name="nombreUsuario" id="nombreUsuario" value="{{ request('nombreUsuario') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 border border-blue-700">
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <br>
                    <!-- Tabla con los datos -->
                    <table class="table-auto w-full text-left mt-4">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-200">ID de Empleado</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-200">Nombre de Empleado</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-200">Departamento</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-200">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
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
                                            <select name="nuevoDepartamento" class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
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
                                                <option value="SIN DEFINIR">SIN DEFINIR</option>
                                                <option value="TRANSPORTE">TRANSPORTE</option>
                                                <option value="UAU">UAU</option>
                                                <option value="VIGILANCIA">VIGILANCIA</option>
                                            </select>

                                            <!-- Botón de asignar -->
                                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 border border-blue-700">
                                                Asignar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Modal -->
                    <div id="modal-departamento" class="fixed z-10 inset-0 overflow-y-auto hidden">
                        <div class="flex items-center justify-center min-h-screen">
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg w-full">
                                <!-- Modal header -->
                                <div class="flex justify-between items-center pb-3">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Asignar Nuevo Departamento</h3>
                                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <form id="asignar-departamento-form" method="POST" action="{{ route('actualizar.departamento') }}">
                                    @csrf
                                    <!-- ID del empleado (oculto) -->
                                    <input name="idEmpleado" id="idEmpleado" value="{{ $registro->IdEmpleado }}">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID del Empleado</label>
                                        <p id="IdEmpleados" class="text-gray-900 dark:text-gray-100"></p>
                                    </div>
                                    <!-- Información del empleado -->
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre del Empleado</label>
                                        <p id="nombreEmpleado" class="text-gray-900 dark:text-gray-100"></p>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Departamento Actual</label>
                                        <p id="departamentoActual" class="text-gray-900 dark:text-gray-100"></p>
                                    </div>
                                    <!-- Lista de departamentos -->
                                    <div class="mb-4">
                                        <label for="nuevoDepartamento" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Seleccionar Nuevo Departamento</label>
                                        <select id="nuevoDepartamento" name="nuevoDepartamento" class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
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
                                            <option value="SIN DEFINIR">SIN DEFINIR</option>
                                            <option value="TRANSPORTE">TRANSPORTE</option>
                                            <option value="UAU">UAU</option>
                                            <option value="VIGILANCIA">VIGILANCIA</option>
                                        </select>
                                    </div>
                                    <!-- Botón de guardar -->
                                    <div class="flex justify-end">
                                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
