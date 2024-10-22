
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
                    <h3 class="text-lg font-medium mb-4">Buscar por Nombre o Departamento</h3>

                    <!-- Formulario de filtros -->
                    <form method="GET" action="{{ route('adminempleados') }}" class="space-y-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="nombreUsuario" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de Empleado</label>
                                <input type="text" name="nombreUsuario" id="nombreUsuario" value="{{ request('nombreUsuario') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div>
                                <label for="departamento" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Departamento</label>
                                <input type="text" name="departamento" id="departamento" value="{{ request('departamento') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 border border-blue-700">
                                Buscar
                            </button>
                        </div>
                    </form>
                    <br>
                    <br>

                    <!-- Tabla con los datos -->
                    <table class="table-auto w-full text-left mt-8">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-200">Nombre de Empleado</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-200">Departamento</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-200">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
                            @foreach ($registros as $registro)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-300">{{ $registro->NombreUsuario }}</td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-300">{{ $registro->Departamento }}</td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-300"> 
                                        <div class="mt-4">
                                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 border border-blue-700">
                                                Asignar Nuevo Departamento
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Paginación -->
                    <div class="mt-6">
                        {{ $registros->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
