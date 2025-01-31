<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
    <style>
        body { font-family: 'Arial', sans-serif; margin: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header img { height: 120px; width: 110px; }
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
    <h1 style="text-align: center;">Reporte de Asistencia</h1>
    <h1 style="text-align: center;">{{$hoy}}</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Departamento</th>
                <th>Fecha</th>
                <th>Hora Registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registros as $registro)
                <tr>
                    <td>{{ $registro->ID }}</td>
                    <td>{{ $registro->Name }}</td>
                    <td>{{ $registro->Departamento ?? 'Sin Departamento' }}</td>
                    <td>{{ $registro->Fecha }}</td>
                    <td>{{ $registro->HoraRegistro }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>