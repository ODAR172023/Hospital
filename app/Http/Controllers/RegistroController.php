<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard');
    }

    public function adminempleados(Request $request)
    {
        // Obtener filtros de la solicitud
        $idEmpleado = $request->input('idEmpleado');
        $nombreUsuario = $request->input('nombreUsuario');

        // Construir la consulta con filtros
        $query = DB::table('Usuarios as u')
            ->leftJoin('Departamento as d', 'd.idEmpleado', '=', 'u.EnrollNumber')
            ->select(
                'u.EnrollNumber as IdEmpleado',  // Mostrar el ID del empleado
                'u.Name as NombreUsuario',       // Mostrar el nombre del empleado
                'd.NombreDepartamento as Departamento' // Mostrar el departamento
            );

        // Aplicar filtros si existen
        if ($idEmpleado) {
            // Coincidencia exacta con el ID del empleado
            $query->where('u.EnrollNumber', '=', $idEmpleado);
        }

        if ($nombreUsuario) {
            $query->where('u.Name', 'like', '%' . $nombreUsuario . '%');
        }

        // Agrupar por ID del empleado para evitar duplicados
        $query->groupBy('u.EnrollNumber', 'u.Name', 'd.NombreDepartamento');

        // Ejecutar la consulta con paginación (20 registros por página)
        $registros = $query->paginate(20);

        // Retornar la vista del dashboard con los datos paginados y filtrados
        return view('adminempleados', compact('registros'));
    }

    public function asignarDepartamento(Request $request)
    {
    $request->validate([
        'idEmpleado' => 'required|exists:usuarios,id',
        'nuevoDepartamento' => 'required|string',
    ]);

    $departamento = Departamento::where('idEmpleado', $request->idEmpleado)->first();

    if ($departamento) {
        $departamento->NombreDepartamento = $request->nuevoDepartamento;

        // Verificar actualización exitosa
        if ($departamento->save()) {
        return redirect()->route('adminempleados')->with('status', 'Departamento actualizado con éxito.');
        } else {
        return redirect()->back()->with('error', 'Error al actualizar el departamento.');
        }
    } else {
        // Manejar el caso en el que no se encontró el registro
        return redirect()->back()->with('error', 'No se encontró el empleado.');
    }
    }

}
