<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jmrashed\Zkteco\Lib\ZKTeco;
use App\Models\Asistencia;

class ZKTecoController extends Controller
{
    public function obtenerAsistencias()
    {
        //Configuración del dispositivo ZKTeco
        //$ip = '10.0.1.179';  // IP del dispositivo ZKTeco en la red
        //$port = 4370;       // Puerto (por defecto es 4370)
        // Crear una instancia de la biblioteca ZKTeco
        
        $zk = new ZKTeco('10.0.1.179', 4370);
        
        // Intentar conectarse al dispositivo
        if ($zk->connect()) {
            // Desactivar temporalmente el dispositivo mientras se extraen los datos
            $zk->disableDevice();

            // Obtener los registros de asistencia
            $asistencias = $zk->getAttendance();

            // Volver a habilitar el dispositivo
            $zk->enableDevice();

            // Desconectar del dispositivo
            $zk->disconnect();

            foreach ($asistencias as $asistencia) {
                Asistencia::create([
                    'empleado_id' => $asistencia['uid'],
                    'timestamp' => $asistencia['timestamp'],
                    'status' => $asistencia['status']
                ]);
            }
    
            return response()->json([
                'status' => 'success',
                'message' => 'Asistencias guardadas correctamente',
                'data' => $asistencias
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo conectar al dispositivo ZKTeco'
            ]);
        }
    }
}
