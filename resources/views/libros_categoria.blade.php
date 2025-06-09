<html>
<head>
    <title>Libros de {{ $categoria->nombre }}</title>
</head>
<body style="background-color: rgb(207, 208, 228);">
    <h2>Libros de la categoría: {{ $categoria->nombre }}</h2>
   <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
    <form method="GET" style="display: flex; gap: 10px;">
        <input type="text" name="busqueda" placeholder="Buscar libro..." value="{{ request('busqueda') }}" 
               style="padding: 10px; font-size: 16px; width: 400px; border-radius: 5px; border: 1px solid #ccc;">
        
        <button type="submit" 
                style="padding: 10px 25px; font-size: 16px; border: none; border-radius: 5px;
                       background-color:rgb(53, 38, 65); color: white; cursor: pointer;">
            Buscar
        </button>
    </form>
</div>



    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        @forelse($libros as $libro)
            <div style="width: 30%; border: 1px solid #ccc; padding: 10px;">
                @if ($libro->portada)
                        <img src="{{ asset('storage/' . $libro->portada) }}" style="width:100%; height:200px; object-fit:cover;">
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
