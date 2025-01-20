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
</head>
<body>
    <h1 style="text-align: center;">Reporte de Asistencia</h1>
    <h1 style="text-align: center;">{{ $hoy}}</h1>
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