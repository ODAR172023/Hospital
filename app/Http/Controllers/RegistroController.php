<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    public function index()
    {
        // Realiza la consulta a la base de datos
        $registros = DB::select("
            SELECT 
                u.Name AS NombreUsuario,
                d.NombreDepartamento AS Departamento,
                DATE(STR_TO_DATE(r.LogDateTime, '%d/%m/%Y %H:%i:%s')) AS Fecha,
                MIN(r.LogDateTime) AS HoraEntrada,
                MAX(r.LogDateTime) AS HoraSalida
            FROM 
                Usuarios u
            LEFT JOIN 
                Registros r ON r.IndRegID = u.EnrollNumber
            LEFT JOIN 
                Departamento d ON d.idEmpleado = u.EnrollNumber
            GROUP BY 
                u.Name, d.NombreDepartamento, Fecha
            ORDER BY 
                Fecha;
        ");

        // Retorna la vista del dashboard con los datos
        return view('dashboard', compact('registros'));
    }
}
