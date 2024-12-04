<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function ejecutarModulo()
    {
        $path = public_path('archivos/BioMetrixCore.exe'); // Asegúrate de que la ruta al archivo .exe sea correcta

        // Ejecutar el archivo .exe
        $output = null;
        $resultCode = null;
        exec($path, $output, $resultCode);

        return redirect('/dashboard');
    }
}
