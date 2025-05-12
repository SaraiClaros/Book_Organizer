@extends('barra')

@section('title', 'Inicio - Biblioteca')

@section('content')

    <div class="container">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
        <h1>📚 Bienvenido a la Biblioteca</h1>

        <div class="regis">
            <ul>
            <li class="row">
                <a href="{{ route('libro.index') }}">📘 Libros</a>
                <a href="{{ route('usuario.index') }}">👤 Usuarios</a>
                <a href="{{ route('prestamos.index') }}">📤 Préstamos</a>
            </li>
            <li class="row">
                <a href="{{ route('devoluciones.index') }}">📥 Devoluciones</a>
                <a href="{{ route('historial.index') }}">📄 Historial</a>
                <a href="{{ route('genero.index') }}">🏷️ Géneros</a>
                <a href="{{ route('existencias.index') }}">📦 Existencias</a>
            </li>
    
        </div>

       

        <div class="content">
            <p>Bienvenido a la Biblioteca Central, donde puedes explorar una gran variedad de libros, gestionar tus préstamos y devoluciones, y más.</p>
        </div>
    </div>

@endsection
