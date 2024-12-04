<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ModuloController;

//Route::get('/', function () {
//return view('welcome');
//});

Route::get('/', function () {
    return redirect()->route('login'); // Redirecciona a /login
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/ejecutar-modulo', [ModuloController::class, 'ejecutarModulo']);
Route::get('/reporte-asistencia', [ReporteController::class, 'create'])->middleware(['auth', 'verified'])->name('reporte.asistencia');
Route::post('/reporte-asistencia', [ReporteController::class, 'store'])->middleware(['auth', 'verified'])->name('generar.reporte');

Route::get('/dashboard', [RegistroController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/adminempleados', [RegistroController::class, 'adminempleados'])->middleware(['auth', 'verified'])->name('adminempleados');
Route::post('/asignar-departamento', [RegistroController::class, 'asignarDepartamento'])->name('asignar.departamento');
Route::post('/actualizar-departamento', [DepartamentoController::class, 'asignarDepartamento'])->name('actualizar.departamento');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
