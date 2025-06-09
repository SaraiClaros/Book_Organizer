@extends('layouts.navigation')

@section('title', 'Historial - Biblioteca')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Actividad</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

</head>
<body>
    <h1 style="color: #DAF7A6 ;">Registrar Nueva Actividad</h1>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="historialForm" action="{{ route('historial.store') }}" method="POST">
    @csrf

    <label for="historial_id">ID del Historial (Solo para consulta):</label>
    <input type="number" id="historial_id" name="historial_id"><br><br>

    <label for="usuarios_id">Usuario:</label>
    <select name="usuarios_id" id="usuarios_id" required>
        <option value="">-- Seleccionar Usuario --</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->usuarios_id }}" {{ (isset($prestamo) && $prestamo->usuarios_id == $usuario->usuarios_id) ? 'selected' : '' }}>
                {{ $usuario->nombre }}
            </option>
        @endforeach
    </select>

    <label for="accion">Acción:</label>
    <input type="text" id="accion" name="accion" required><br><br>

    <label for="detalle">Detalle:</label><br>
    <textarea id="detalle" name="detalle" rows="4" cols="50"></textarea><br><br>

    <label for="fecha">Fecha:</label>
    <input type="datetime-local" id="fecha" name="fecha" required><br><br>

    <div class="botones">
        <button type="submit">📘 Guardar historial</button>
        <button type="button" id="consultar">🔍 Consultar historial</button>
        <button type="button" id="modificar">✏️ Modifica historialr</button>
    </div>
</form>

<br>
<a href="{{ route('historial.index') }}" class="enlace-volver">🔙 Ver historial</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#consultar').on('click', function() {
            var historial_id = $('#historial_id').val();

            $.ajax({
                url: '{{ route('historial.consultar') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    historial_id: historial_id,
                },
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        $('#usuarios_id').val(response.usuarios_id);
                        $('#accion').val(response.accion);
                        $('#detalle').val(response.detalle);
                        let fechaOriginal = response.fecha;
                        let fechaFormateada = new Date(fechaOriginal).toISOString().slice(0,16);
                        $('#fecha').val(fechaFormateada);

                    }
                },
                error: function() {
                    alert('Ocurrió un error al consultar el historial.');
                }
            });
        });
    });

    $('#modificar').on('click', function() {
        let historialId = $('#historial_id').val();

        if (!historialId) {
            alert('Ingresa un ID de historial para modificar.');
            return;
        }

        let form = $('#historialForm');
        form.attr('action', '/historial/' + historialId);
        form.append('@method("PUT")');
        form.submit();
    });
</script>
</body>
</html>
@endsection