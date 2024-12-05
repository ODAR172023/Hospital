<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReporteController extends Controller
{
    public function create()
    {
        // Consultar la información de los empleados eliminando duplicados
        $empleados = DB::table('Usuarios as u')
            ->leftJoin('Departamento as d', 'd.idEmpleado', '=', 'u.EnrollNumber')
            ->select(
                'u.EnrollNumber as IdEmpleado',      // ID único del empleado
                'u.Name as NombreUsuario',           // Nombre del empleado
                'd.NombreDepartamento as Departamento' // Departamento
            )
            ->distinct()
            ->get();

        // Retornar la vista con la lista de empleados
        return view('reporte-asistencia', compact('empleados'));
    }


    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'idEmpleado' => 'required|integer',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        // Retrieve the employee and department details
        $empleado = DB::table('Usuarios as u')
            ->leftJoin('Departamento as d', 'd.idEmpleado', '=', 'u.EnrollNumber')
            ->where('u.EnrollNumber', $request->idEmpleado)
            ->select('u.Name', 'd.NombreDepartamento as Departamento')
            ->first();

        if (!$empleado) {
            return redirect()->back()->with('error', 'Empleado no encontrado.');
        }

        // Adjust the date format for LogDateTime to Y-m-d H:i:s for database query
        $registros = DB::table('Registros as r')
            ->leftJoin('Usuarios as u', 'u.EnrollNumber', '=', 'r.IndRegID')
            ->leftJoin('Departamento as d', 'd.idEmpleado', '=', 'u.EnrollNumber')
            ->select(
                'u.EnrollNumber as ID',
                'u.Name',
                'd.NombreDepartamento as Departamento',
                DB::raw("DATE_FORMAT(STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s'), '%Y-%m-%d') as Fecha"),
                DB::raw("MIN(STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s')) as HoraEntrada"),
                DB::raw("MAX(STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s')) as HoraSalida")
            )
            ->where('u.EnrollNumber', $request->idEmpleado)
            ->whereBetween(DB::raw("DATE_FORMAT(STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s'), '%Y-%m-%d')"), [$request->fecha_inicio, $request->fecha_fin])
            ->groupBy('u.EnrollNumber', 'u.Name', 'd.NombreDepartamento', 'Fecha')
            ->orderBy('Fecha', 'asc')
            ->get();

        // Generate the PDF report with the data
        $pdf = PDF::loadView('reporte-asistencia1', [
            'empleado' => $empleado,
            'registros' => $registros,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin
        ]);

        return $pdf->stream('reporte_asistencia.pdf');
    }

}
