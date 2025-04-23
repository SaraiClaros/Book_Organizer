
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Devoluciones</title>

    <link rel="stylesheet" href="{{ asset('css/stilos.css') }}">

    
</head>
<body>
    <h1>Listado de Devoluciones</h1>

    <a href="{{ route('devoluciones.create') }}">Registrar Nueva Devolución</a><br><br>

  
    @if ($devoluciones->isEmpty())
        <p class="no-result">No hay devoluciones registradas.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID del Préstamo</th>
                    <th>Fecha de Devolución Real</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($devoluciones as $devolucion)
                    <tr>
                        <td>{{ $devolucion->prestamo_id }}</td>
                        <td>{{ $devolucion->fecha_devolucion_real }}</td>
                        <td>{{ $devolucion->observaciones }}</td>
                        <td>
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ url('/') }}" class="footer-link">🔙 Volver al inicio</a>

</body>
</html>
