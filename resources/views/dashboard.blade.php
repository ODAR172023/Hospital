<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel Administrativo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Tarjeta: Administrar Usuarios -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                        <div class="mr-4 p-4 bg-blue-500 text-white rounded-full">
                            <!-- Ícono de usuarios -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1112 21V12.012M12 9.988V3M8.66 14.96A8.959 8.959 0 0012 15.9a8.959 8.959 0 003.341-.94M4 15h16" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-2">Administrar Empleados</h3>
                            <p class="text-sm">Gestiona la información de departamentos de los Empleados registrados en el sistema.</p>
                            <a href="{{ route('adminempleados') }}" class="text-blue-500 hover:text-blue-600 mt-2 inline-block">
                                Ver más
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta: Generar Reportes -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                        <div class="mr-4 p-4 bg-green-500 text-white rounded-full">
                            <!-- Ícono de reportes -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-2">Generar Reportes</h3>
                            <p class="text-sm">Genera reportes de asistencia de los empleados.</p>
                            <a href="{{ route('reporte.asistencia') }}" class="text-green-500 hover:text-green-600 mt-2 inline-block">
                                Ver más
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta: Otro módulo
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                        <div class="mr-4 p-4 bg-yellow-500 text-white rounded-full">
                        
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16V8m0 8a4 4 0 004-4H4v4zm8-4h8m0 0V8m0 8a4 4 0 01-4 4H4a4 4 0 01-4-4H4v4zm0-4V8h8V8z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-2">Administrar Reloj Biométrico</h3>
                            <p class="text-sm">Administra y actualiza todos los registros del reloj a la base de datos.</p>
                            <a href="{{ url('/ejecutar-modulo') }}" class="text-yellow-500 hover:text-yellow-600 mt-2 inline-block">
                                Ver más
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Tarjeta: Administrar Usuarios -->
            </div>
        </div>
    </div>
</x-app-layout>

