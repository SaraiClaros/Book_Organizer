<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Existencias</title>
    <link rel="stylesheet" href="{{ asset('css/stilos.css') }}">
</head>
<body>
    <h1>📚 Listado de Existencias</h1>

    <a href="{{ route('existencias.create') }}">➕ Registrar Nueva Existencia</a>
    <br><br>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID Existencia</th>
                <th>Libro ID</th>
                <th>Ubicación General</th>
                <th>Código Identificación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($existencias as $existencia)
                <tr>
                    <td>{{ $existencia->id_existencia }}</td>
                    <td>{{ $existencia->libros_id }}</td>
                    <td>{{ $existencia->ubicacion_general }}</td>
                    <td>{{ $existencia->codigo_identificacion }}</td>

                    <td>
                    <form action="{{ route('existencias.destroy', $existencia->id_existencia) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta existencia?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">🗑️ Eliminar</button>
                   </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a href="{{ url('/') }}">🔙 Volver al inicio</a>
</body>
</html>
