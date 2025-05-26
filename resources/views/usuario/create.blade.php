@extends('layouts.navigation')

@section('title', 'Usuario - Biblioteca')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Nuevo Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <h1 style="color: #DAF7A6 ;">👤 Registrar Nuevo Usuario</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usuario.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" class="borde-negro" name="nombre" value="{{ old('nombre', $usuario->nombre ?? '') }}" required><br><br>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" class="borde-negro" name="email" value="{{ old('email', $usuario->email ?? '') }}" required><br><br>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="borde-negro" name="password"><br><br>
        </div>

        <div class="form-group">
            <label for="rol">Rol:</label>
            <select name="rol">
                <option value="admin" {{ old('rol', $usuario->rol ?? '') == 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="lector" {{ old('rol', $usuario->rol ?? '') == 'lector' ? 'selected' : '' }}>Lector</option>
            </select><br><br>
        </div>

        <div class="butones">
            <button type="submit" name="accion" value="guardar">📘 Guardar Usuario</button>
            <button type="submit" name="accion" value="consultar">🔍 Consultar Usuario</button>
            <button type="submit" name="accion" value="modificar">✏️ Modificar Usuario</button>
            <button type="submit" name="accion" value="eliminar">🗑️ Eliminar Usuario</button>
        </div>
    </form>

    <br>
    <a href="{{ route('usuario.index') }}" class="enlace-volver">🔙 Ver listado de usuarios</a>
</body>
</html>

@endsection
