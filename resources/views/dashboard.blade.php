<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">Registro de Usuarios</h3>

                    <table class="table-auto w-full text-left mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Nombre de Usuario</th>
                                <th class="px-4 py-2">Departamento</th>
                                <th class="px-4 py-2">Fecha</th>
                                <th class="px-4 py-2">Hora de Entrada</th>
                                <th class="px-4 py-2">Hora de Salida</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registros as $registro)
                                <tr>
                                    <td class="border px-4 py-2">{{ $registro->NombreUsuario }}</td>
                                    <td class="border px-4 py-2">{{ $registro->Departamento }}</td>
                                    <td class="border px-4 py-2">{{ $registro->Fecha }}</td>
                                    <td class="border px-4 py-2">{{ $registro->HoraEntrada }}</td>
                                    <td class="border px-4 py-2">{{ $registro->HoraSalida }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
