@extends('layouts.navigation')

@section('title', 'Listado de Préstamos')

@section('content')
<h1>Listado de Préstamos</h1>

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>ID Préstamo</th>
            <th>Usuario</th>
            <th>Libro</th>
            <th>Fecha Préstamo</th>
            <th>Fecha Devolución</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($prestamos as $prestamo)
            <tr>
                <td>{{ $prestamo->prestamos_id }}</td>
                <td>{{ $prestamo->usuarios->nombre ?? 'Sin usuario' }}</td>
                <td>{{ $prestamo->libros->titulo ?? 'Sin libro' }}</td>
                <td>{{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($prestamo->fecha_devolucion)->format('Y-m-d') }}</td>
                <td>{{ $prestamo->estado }}</td>
                <td>
                    <form action="{{ route('prestamos.destroy', $prestamo->prestamos_id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Seguro que quieres eliminar este préstamo?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">🗑️ Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align:center;">No hay préstamos registrados.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<br>
<a href="{{ route('prestamos.create') }}">➕ Registrar Nuevo Préstamo</a>
@endsection
