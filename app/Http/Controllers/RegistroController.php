<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    public function index(Request $request)
    {
        // Obtener filtros de la solicitud
        $nombreUsuario = $request->input('nombreUsuario');
        $departamento = $request->input('departamento');

        // Construir la consulta con filtros
        $query = DB::table('Usuarios as u')
            ->leftJoin('Registros as r', 'r.IndRegID', '=', 'u.EnrollNumber')
            ->leftJoin('Departamento as d', 'd.idEmpleado', '=', 'u.EnrollNumber')
            ->select(
                'u.Name as NombreUsuario',
                'd.NombreDepartamento as Departamento',
                DB::raw("DATE(STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s')) as Fecha"),
                DB::raw("MIN(r.LogDateTime) as HoraEntrada"),
                DB::raw("MAX(r.LogDateTime) as HoraSalida")
            )
            ->groupBy('u.Name', 'd.NombreDepartamento', 'Fecha');

        // Aplicar filtros si existen
        if ($nombreUsuario) {
            $query->where('u.Name', 'like', '%' . $nombreUsuario . '%');
        }

        if ($departamento) {
            $query->where('d.NombreDepartamento', 'like', '%' . $departamento . '%');
        }

        // Ejecutar la consulta con paginación (10 registros por página)
        $registros = $query->orderBy('Fecha', 'asc')->paginate(20);

        // Retornar la vista del dashboard con los datos paginados y filtrados
        return view('dashboard', compact('registros'));
    }

    public function adminempleados(Request $request)
    {
        // Obtener filtros de la solicitud
        $nombreUsuario = $request->input('nombreUsuario');
        $departamento = $request->input('departamento');

        // Construir la consulta con filtros
        $query = DB::table('Usuarios as u')
            ->leftJoin('Registros as r', 'r.IndRegID', '=', 'u.EnrollNumber')
            ->leftJoin('Departamento as d', 'd.idEmpleado', '=', 'u.EnrollNumber')
            ->select(
                'u.Name as NombreUsuario',
                'd.NombreDepartamento as Departamento',
                DB::raw("DATE(STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s')) as Fecha"),
                DB::raw("MIN(r.LogDateTime) as HoraEntrada"),
                DB::raw("MAX(r.LogDateTime) as HoraSalida")
            )
            ->groupBy('u.Name', 'd.NombreDepartamento', 'Fecha');

        // Aplicar filtros si existen
        if ($nombreUsuario) {
            $query->where('u.Name', 'like', '%' . $nombreUsuario . '%');
        }

        if ($departamento) {
            $query->where('d.NombreDepartamento', 'like', '%' . $departamento . '%');
        }

        // Ejecutar la consulta con paginación (10 registros por página)
        $registros = $query->orderBy('Fecha', 'asc')->paginate(20);

        // Retornar la vista del dashboard con los datos paginados y filtrados
        return view('adminempleados', compact('registros'));
    }
}
