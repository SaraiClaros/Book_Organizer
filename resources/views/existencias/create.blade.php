@extends('layouts.navigation')

@section('title', 'Existencias - Biblioteca')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Existencia</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

</head>
<body>
    <h1 style="color: #DAF7A6 ;">Registrar Nueva Existencia</h1>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="form-existencia" method="POST" action="{{ route('existencias.store') }}">
    @csrf

    <input type="hidden" name="id_existencia" id="id_existencia">

    <label for="codigo_identificacion">Código de Identificación:</label>
    <input type="text" name="codigo_identificacion" id="codigo_identificacion" required><br><br>

    <label for="libros_id">ID del Libro:</label>
    <input type="number" name="libros_id" id="libros_id" required><br><br>

    <label for="ubicacion_general">Ubicación General:</label>
    <input type="text" name="ubicacion_general" id="ubicacion_general" required><br><br>

    <div class="botones">
        <button type="button" id="consultar">Consultar Existencia</button>
        <button type="button" id="modificar">Modificar Existencia</button>
        <button type="submit">Guardar Existencia</button>
    </div>
</form>

    <br>
    <a href="{{ route('existencias.index') }}">🔙 Ver existencias registradas</a>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#consultar').on('click', function () {
        const codigo = $('#codigo_identificacion').val();

        if (!codigo) {
            alert('Debes ingresar el código de identificación para consultar.');
            return;
        }

        $.ajax({
            url: '{{ route('existencia.consultar') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                codigo_identificacion: codigo
            },
            success: function (response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    $('#id_existencia').val(response.id_existencia);
                    $('#libros_id').val(response.libros_id);
                    $('#ubicacion_general').val(response.ubicacion_general);
                }
            },
            error: function () {
                alert('Error al consultar la existencia.');
            }
        });
    });

    $('#modificar').on('click', function () {
        const id = $('#id_existencia').val();
        if (!id) {
            alert('Primero debes consultar una existencia.');
            return;
        }

        const form = $('#form-existencia');
        form.attr('action', '/existencias/' + id);
        if (!$('input[name="_method"]').length) {
            form.append('<input type="hidden" name="_method" value="PUT">');
        }

        form.submit();
    });
});
</script>

</body>
</html>
@endsection