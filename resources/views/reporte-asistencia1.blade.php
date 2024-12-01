<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencia</title>
    <style>
        body { font-family: 'Arial', sans-serif; margin: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header img { height: 60px; margin: 1 30px; }
        .company-info { text-align: center; margin-bottom: 15px; color: #555; }
        h2 { margin: 5px; font-size: 22px; color: #0056b3; }
        p { margin: 3px; font-size: 14px; }
        .report-details { text-align: center; font-size: 14px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; font-size: 12px; }
        th { background-color: #0056b3; color: white; }
        .day-row { background-color: #f0f8ff; font-weight: bold; }
        .divider { border-top: 2px solid #0056b3; margin: 10px 0; }
    </style>
</head>
<body>
<div class="header">
    
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo1.png'))) }}" class="h-50 w-70" style="float: left;">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo3.png'))) }}" class="h-50 w-70" style="float: right;">
        <h2>HOSPITAL SAN LORENZO</h2>
        <p><strong>Secretaría de Salud</strong></p>
        
        <div class="divider"></div>
    </div>

    <div class="company-info">
        <strong><p>Tarjeta de Asistencia</p></strong>
        <p>Del {{ \Carbon\Carbon::parse($fecha_inicio)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') }}</p>
    </div>

    <div class="report-details">
        <p><strong>Empleado:</strong> {{ $empleado->Name }}</p>
        <p><strong>Departamento:</strong> {{ $empleado->Departamento ?? 'No asignado' }}</p>
    </div>

    <table>
        <thead>
            <!-- Encabezados de los días del mes -->
            <tr>
                @foreach(range(1, 7) as $i) <!-- Cambia 7 por el número de días que quieres mostrar por fila -->
                    <th>Fecha</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($registros->chunk(7) as $semana) <!-- Agrupa los registros en filas de 7 días -->
                <tr>
                    @foreach($semana as $registro)
                        <td class="day-cell">
                            <div class="day-header">
                                {{ \Carbon\Carbon::parse($registro->Fecha)->locale('es')->translatedFormat('l, d/m/Y') }}
                            </div>
                            <div class="day-content">
                                <p><strong>Entrada:</strong> {{ \Carbon\Carbon::parse($registro->HoraEntrada)->format('H:i') ?? '-' }}</p>
                                <p><strong>Salida:</strong> {{ \Carbon\Carbon::parse($registro->HoraSalida)->format('H:i') ?? '-' }}</p>
                            </div>
                        </td>
                    @endforeach
                    <!-- Añade celdas vacías si la semana no tiene 7 registros -->
                    @for($i = count($semana); $i < 7; $i++)
                        <td class="day-cell"></td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div style="margin-top: 20px; text-align: center;">
        <p><strong>___________________________________</strong></p> <!-- Actualizar este valor dinámicamente si es necesario -->
        <p><strong>Ing. Elder Girón</strong></p>
        <p><strong>Jefe Tecnología e Información</strong></p>
    </div>
</body>
</html>
