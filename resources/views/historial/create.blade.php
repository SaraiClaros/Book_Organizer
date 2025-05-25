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

    <form action="{{ route('historial.store') }}" method="POST">
        @csrf

        <div class="form-group">
        <label for="usuarios_id">ID del Usuario:</label>
        <input type="number" class="borde-negro"  name="usuarios_id" required><br><br>
         </div>

        <div class="form-group">
        <label for="accion">Acción:</label>
        <input type="text" class="borde-negro"  name="accion" required><br><br>
         </div>

        <div class="form-group">
        <label for="detalle">Detalle:</label><br>
        <textarea name="detalle"  class="borde-negro" rows="4" cols="50"></textarea><br><br>
         </div>

        <div class="form-group">
        <label for="fecha">Fecha:</label>
        <input type="datetime-local "  class="borde-negro" name="fecha" required><br><br>
        </div>

        <div class="butones">
            <button type="submit" name="accion" value="guardar">📘 Guardar Historial</button>
            <button type="submit" name="accion" value="consultar">🔍 Consultar Historia</button>
            <button type="submit" name="accion" value="modificar">✏️ Modificar Historial</button>
            <button type="submit" name="accion" value="eliminar">🗑️ Eliminar Historial</button>
        
        </div>
       
    </form>

    <br>
    <a href="{{ route('historial.index') }}" class="enlace-volver">🔙 Ver historial</a>
</body>
</html>
@endsection
