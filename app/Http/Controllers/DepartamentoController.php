<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    public function asignarDepartamento(Request $request)
    {
        //dd($request->all());
        // Validar los datos del formulario
        $request->validate([
            'idEmpleado' => 'required|int',
            'nuevoDepartamento' => 'required|string',
        ]);

        // Actualizar el departamento en la tabla Departamento
        DB::table('departamento')
            ->where('idEmpleado', $request->input('idEmpleado'))
            ->update(['NombreDepartamento' => $request->input('nuevoDepartamento')]);

        // Redirigir con mensaje de éxito
        return redirect()->route('adminempleados')->with('status', 'Departamento actualizado con éxito.');
    }
}
