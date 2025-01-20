<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReporteController extends Controller
{
    public function create(Request $request)
    {
        // Obtener el ID del usuario autenticado
        $idUsuario = Auth::id();

        // Construir la consulta base
        $query = DB::table('Usuarios as u')
            ->leftJoin('Departamento as d', 'd.idEmpleado', '=', 'u.EnrollNumber')
            ->select(
                'u.EnrollNumber as IdEmpleado',      // ID único del empleado
                'u.Name as NombreUsuario',           // Nombre del empleado
                'd.NombreDepartamento as Departamento' // Departamento
            )
            ->distinct();

        // Agregar condiciones según el ID del usuario
        if (in_array($idUsuario, [3, 4, 6])) {
            // Usuarios con ID 3 y 4 tienen acceso a todos los registros
            // No se aplica filtro adicional
        } elseif ($idUsuario == 5) {
            // Usuario con ID 5 solo tiene acceso a departamentos específicos
            $query->whereIn('d.NombreDepartamento', ['Lavandería', 'Cocina', 'Sastrería', 'Aseo']);
        } else {
            // Por defecto, mostrar solo la información del empleado autenticado
            $query->where('u.EnrollNumber', $idUsuario);
        }

        // Ejecutar la consulta
        $empleados = $query->get();

        // Obtener la fecha actual
        $hoy = date('Y-m-d');

        // Filtro por búsqueda de nombre
        $search = $request->input('search', '');

        // Consultar los registros del día actual con búsqueda, orden y paginación
        $registrosHoy = DB::table('Registros as r')
            ->leftJoin('Usuarios as u', 'u.EnrollNumber', '=', 'r.IndRegID')
            ->leftJoin('Departamento as d', 'd.idEmpleado', '=', 'u.EnrollNumber')
            ->select(
                'u.EnrollNumber as ID',
                'u.Name',
                'd.NombreDepartamento as Departamento',
                DB::raw("DATE_FORMAT(STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s'), '%Y-%m-%d') as Fecha"),
                DB::raw("STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s') as HoraRegistro")
            )
            ->whereNotNull('r.LogDateTime')
            ->where(DB::raw("DATE_FORMAT(STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s'), '%Y-%m-%d')"), $hoy)
            ->when($search, function ($query, $search) {
                return $query->where('u.Name', 'LIKE', "%$search%");
            })
            ->orderBy(DB::raw("STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s')"), 'desc')
            ->distinct()
            ->paginate(10);

        return view('reporte-asistencia', compact('empleados', 'registrosHoy', 'search'));
    }

    public function exportPdf()
    {
        $hoy = date('Y-m-d');

        // Obtener los registros del día actual
        $registros = DB::table('Registros as r')
            ->leftJoin('Usuarios as u', 'u.EnrollNumber', '=', 'r.IndRegID')
            ->leftJoin('Departamento as d', 'd.idEmpleado', '=', 'u.EnrollNumber')
            ->select(
                'u.EnrollNumber as ID',
                'u.Name',
                'd.NombreDepartamento as Departamento',
                DB::raw("DATE_FORMAT(STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s'), '%Y-%m-%d') as Fecha"),
                DB::raw("STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s') as HoraRegistro")
            )
            ->whereNotNull('r.LogDateTime')
            ->where(DB::raw("DATE_FORMAT(STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s'), '%Y-%m-%d')"), $hoy)
            ->orderBy(DB::raw("STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s')"), 'desc')
            ->distinct()
            ->get();

        // Generar el PDF
        $pdf = PDF::loadView('reporte-asistencia-pdf', compact('registros', 'hoy'));

        // Descargar el archivo PDF
        return $pdf->download('reporte-asistencia-' . $hoy . '.pdf');
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
            ->whereNotNull('r.LogDateTime')
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
