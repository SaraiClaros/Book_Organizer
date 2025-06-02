<html>
<head>
    <title>Libros de {{ $categoria->nombre }}</title>
</head>
<body>
    <h2>Libros de la categoría: {{ $categoria->nombre }}</h2>
    <form method="GET">
        <input type="text" name="busqueda" placeholder="Buscar libro..." value="{{ request('busqueda') }}">
        <button type="submit">Buscar</button>
    </form>

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        @forelse($libros as $libro)
            <div style="width: 30%; border: 1px solid #ccc; padding: 10px;">
                @if ($libro->portada)
                    <img src="{{ Storage::url($libro->portada) }}" style="width:100%; height:200px; object-fit:cover;">
                @endif
                <h4>{{ $libro->nombre }}</h4>
                <p>{{ $libro->descripcion }}</p>
                <a href="{{ route('ver.pdf', $libro->id) }}" target="_blank">Ver PDF</a> |
                <a href="{{ route('descargar.pdf', $libro->id) }}">Descargar</a>
            </div>
        @empty
            <p>No hay libros en esta categoría.</p>
        @endforelse
    </div>
    <br>
    <a href="{{ url('/categorias') }}">Volver a Categorías</a>
</body>
</html>
