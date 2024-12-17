<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencia</title>
    <style>
        body { font-family: 'Arial', sans-serif; margin: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header img { height: 120px; width: 110px;}
        .company-info { text-align: center; margin-bottom: 15px; color: #555; }
        h2 { margin: 5px; font-size: 22px; color: #00bde5; }
        p { margin: 3px; font-size: 14px; }
        .report-details { text-align: left; font-size: 14px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; font-size: 12px; }
        th { background-color: #0056b3; color: white; }
        .day-row { background-color: #f0f8ff; font-weight: bold; }
        .divider { border-top: 2px solid #0056b3; margin: 10px 0; }
        .signature-table { width: 100%; margin-top: 30px; }
        .signature-table td { text-align: center; vertical-align: top; }
        .signature-line { margin: 0; padding: 0; }
    </style>
</head>
<body>
<div class="header">
    
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo1.png'))) }}" style="float: left; margin-top: -30px;">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo3.png'))) }}" style="float: right; margin-top: -33px;">
        <h2>HOSPITAL SAN LORENZO</h2>
        <p><strong>Secretaría de Salud</strong></p>
        
    </div>
    <div class="divider"></div>

    <div class="report-details">
        <p><strong>Empleado:</strong> {{ $empleado->Name }} </p>
        <p><strong>Departamento:</strong> {{ $empleado->Departamento ?? 'No asignado' }}</p>
    </div>

    <div class="divider"></div>

    <div class="company-info">
        <strong><p><u>Tarjeta de Asistencia</u></p></strong>
        <p><u>Del {{ \Carbon\Carbon::parse($fecha_inicio)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') }}</u></p>
    </div>

    <table>
        <tbody>
            @foreach($registros->chunk(7) as $semana) <!-- Agrupa los registros en filas de 7 días -->
                <tr>
                    @foreach($semana as $registro)
                        <td class="day-cell" style="margin: 0px; padding: 0px; width: 80px;">
                            <div class="day-header" style="background-color: #00bde5; color:black; width: 100%; height: 50px; paddin: 40px;">
                               <p style="padding-top: 7px;"> {{ \Carbon\Carbon::parse($registro->Fecha)->locale('es')->translatedFormat('l, d/m/Y') }} </p>
                            </div>
                            <div class="day-content">
                                @if (\Carbon\Carbon::parse($registro->HoraEntrada)->format('Y-m-d H:i') === \Carbon\Carbon::parse($registro->HoraSalida)->format('Y-m-d H:i'))
                                    <!-- Si la fecha y hora de entrada y salida son iguales -->
                                    <br>
                                    <p><strong>Entrada o</strong></p>
                                    <p><strong>Salida: </strong></p>
                                    <p>{{ \Carbon\Carbon::parse($registro->HoraEntrada)->format('H:i') ?? '-' }}</p>
                                @else
                                    <!-- Si son diferentes, muestra entrada y salida por separado -->
                                    <p><strong>Entrada:</strong> {{ \Carbon\Carbon::parse($registro->HoraEntrada)->format('H:i') ?? '-' }}</p>
                                    <p><strong>Salida: </strong> {{ \Carbon\Carbon::parse($registro->HoraSalida)->format('H:i') ?? '-' }}</p>
                                @endif
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
    <!-- Usamos una tabla sin bordes para las firmas -->
    <table class="signature-table"  style="width: 100%; margin-top: 30px; border-collapse: collapse;">
        <tr>
            <td style="text-align: center; border: 0; vertical-align: top; padding: 0;">
                <p class="signature-line" style="margin: 0;">___________________________________</p>
                <p><strong>Abog. HECTOR ALVAREZ</strong></p>
                <p><strong>Jefe de Recursos Humanos</strong></p>
            </td>
            <td style="text-align: center; border: 0; vertical-align: top; padding: 0;">
                <p class="signature-line" style="margin: 0;">___________________________________</p>
                <p><strong>{{ $empleado->Name }} </strong></p>
                <p><strong>Empleado</strong></p>
            </td>
        </tr>
    </table>
    <br>
    <!-- <hr style="border: 0; border-top: 1px solid #000; width: 100%; margin: 20px 0;"> -->
    <div style="text-align: justify; font-size: 12px;">
        *Acepto de conformidad el contenido de la presente tarjeta de asistencia por ser el horario de trabajo dentro del cual me desempeñé al
        servicio de <strong>HOSPITAL SAN LORENZO</strong>, durante el periodo que ampara dicho documento, por lo que no existe reclamación alguna al
        respecto, firmando al calce para constancia y aprobación de sus alcances legales.
    </div>
</body>
</html>
