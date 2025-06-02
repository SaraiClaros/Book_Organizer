@extends('layouts.navigation')

@section('title', 'Registros - Biblioteca')

@section('content')

    <div class="container">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
        <h1 style="color: #DAF7A6 ;">📚 Bienvenido a Registros</h1>


        <div class="regis">
            <ul>
            <li class="row">
                <a href="{{ route('libro.index') }}">📘 Libros</a>
                <a href="{{ route('usuario.index') }}">👤 Usuarios</a>
                <a href="{{ route('prestamos.index') }}">📤 Préstamos</a>
                <a href="{{ route('formulario.pdf') }}">📄 Subir Libro</a>
            </li>
            <li class="row">
                <a href="{{ route('devoluciones.index') }}">📥 Devoluciones</a>
                <a href="{{ route('historial.index') }}">📄 Historial</a>
                <a href="{{ route('genero.index') }}">🏷️ Géneros</a>
                <a href="{{ route('existencias.index') }}">📦 Existencias</a>
               

            </li>
    
        </div>

       
    </div>

@endsection
