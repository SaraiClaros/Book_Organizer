@extends('layouts.navigation')

@section('title', 'Préstamos - Gestión')

@section('content')
<h1>Registrar Nuevo Préstamo</h1>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error) 
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('prestamos.store') }}" method="POST">
    @csrf
    <label for="prestamos_id">ID Préstamo:</label>
    <input type="number" id="prestamos_id" name="prestamos_id" value="{{ old('prestamos_id', $prestamo->prestamos_id ?? '') }}" required>

    <label for="usuarios_id">Usuario:</label>
    <select name="usuarios_id" id="usuarios_id" required>
        <option value="">-- Seleccionar Usuario --</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->usuarios_id }}" {{ (isset($prestamo) && $prestamo->usuarios_id == $usuario->usuarios_id) ? 'selected' : '' }}>
                {{ $usuario->nombre }}
            </option>
        @endforeach
    </select>

    <label for="libros_id">Libro:</label>
    <select name="libros_id" id="libros_id" required>
        <option value="">-- Seleccionar Libro --</option>
        @foreach($libros as $libro)
            <option value="{{ $libro->libros_id }}" {{ (isset($prestamo) && $prestamo->libros_id == $libro->libros_id) ? 'selected' : '' }}>
                {{ $libro->titulo }}
            </option>
        @endforeach
    </select>

    <label for="fecha_prestamo">Fecha de Préstamo:</label>
    <input type="date" id="fecha_prestamo" name="fecha_prestamo" value="{{ old('fecha_prestamo', isset($prestamo) ? $prestamo->fecha_prestamo->format('Y-m-d') : '') }}" >

    <label for="fecha_devolucion">Fecha de Devolución:</label>
    <input type="date" id="fecha_devolucion" name="fecha_devolucion" value="{{ old('fecha_devolucion', isset($prestamo) ? $prestamo->fecha_devolucion->format('Y-m-d') : '') }}" >

    <label for="estado">Estado:</label>
    <select name="estado" id="estado" required>
        <option value="En curso" {{ (isset($prestamo) && $prestamo->estado == 'En curso') ? 'selected' : '' }}>En curso</option>
        <option value="Devuelto" {{ (isset($prestamo) && $prestamo->estado == 'Devuelto') ? 'selected' : '' }}>Devuelto</option>
        <option value="Atrasado" {{ (isset($prestamo) && $prestamo->estado == 'Atrasado') ? 'selected' : '' }}>Atrasado</option>
    </select>

    <div class="butones">
        <button type="submit" name="accion" value="guardar">📘 Guardar</button>
        <button type="submit" name="accion" value="consultar">🔍 Consultar Libro</button>
        <button type="submit" name="accion" value="modificar">✏️ Modificar Libro</button>
        <button type="submit" name="accion" value="eliminar">🗑️ Eliminar Libro</button>

    </div>


</form>

<script>
$(document).ready(function(){
    $('button[name="accion"][value="consultar"]').click(function(e){
        e.preventDefault();  

       
        var prestamos_id = $('#prestamos_id').val();
        var usuarios_id = $('#usuarios_id').val();
        var libros_id = $('#libros_id').val();

        if(prestamos_id === '' || usuarios_id === '' || libros_id === '') {
            alert('Por favor, complete los primeros tres campos antes de consultar.');
            return;
        }

        // Hacer petición AJAX a una ruta para consultar datos
        $.ajax({
            url: '{{ route("prestamos.consultar") }}', // Ruta para consulta, crea esta en web.php
            method: 'POST',
            data: {
                prestamos_id: prestamos_id,
                usuarios_id: usuarios_id,
                libros_id: libros_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response){
                // Llenar los campos con la respuesta recibida
                $('#fecha_prestamo').val(response.fecha_prestamo);
                $('#fecha_devolucion').val(response.fecha_devolucion);
                $('#estado').val(response.estado);
            },
            error: function(){
                alert('No se encontró el préstamo con los datos proporcionados.');
                // Limpiar campos si quieres
                $('#fecha_prestamo').val('');
                $('#fecha_devolucion').val('');
                $('#estado').val('');
            }
        });
    });
});
</script>

@endsection
