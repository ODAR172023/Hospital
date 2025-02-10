<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function index()
    {
        // Solo el administrador puede acceder
        if (Auth::user()->id !== 3) { // Cambia "1" por el ID real del administrador
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        $logs = DB::table('logs')->orderBy('fecha_generacion', 'desc')->get();

        return view('logs', compact('logs'));
    }
}
