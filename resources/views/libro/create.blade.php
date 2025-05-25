@extends('layouts.navigation')

@section('title', 'Libro - Biblioteca')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1 style="color: #DAF7A6 ;">📚 Registrar Nuevo Libro</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="libroForm" action="{{ route('libro.store') }}" method="POST">
        <input type="hidden" name="libros_id" value="{{ old('libros_id', $libros->libros_id ?? '') }}">

        @csrf
        <div class="form-group">
        <label for="titulo">Título:</label>
        <input type="text" class="borde-negro" id="titulo" name="titulo" value="{{ old('titulo', $libros->titulo ?? '') }}" required>
        </div>
         
        <div class="form-group">
        <label for="autor">Autor:</label>
        <input type="text" class="borde-negro" id="autor" name="autor" value="{{ old('autor', $libros->autor ?? '') }}" required>
        </div>

        <div class="form-group">
        <label for="editorial">Editorial:</label>
        <input type="text" class="borde-negro" name="editorial" id="editorial" value="{{ old('editorial', $libros->editorial ?? '') }}" >
        </div>

        <div class="form-group">
        <label for="anio_publicacion">Año de Publicación:</label>
        <input type="number" class="borde-negro" name="anio_publicacion" id="anio_publicacion" value="{{ old('anio_publicacion', $libros->anio_publicacion ?? '') }}" >
        </div>

        <div class="form-group">
        <label for="genero">Género:</label>
        <input type="text" class="borde-negro" name="genero" id="genero" value="{{ old('genero', $libros->genero ?? '') }}" >
        </div>

        <div class="form-group">
        <label for="clasificacion_tematica">Clasificación Temática:</label>
        <input type="text" class="borde-negro" name="clasificacion_tematica" id="clasificacion_tematica" value="{{ old('clasificacion_tematica', $libros->clasificacion_tematica ?? '') }}">
        </div>

        <div class="form-group">
        <label for="cantidad_disponible">Cantidad Disponible:</label>
        <input type="number" class="borde-negro" name="cantidad_disponible" id="cantidad_disponible" value="{{ old('cantidad_disponible', $libros->cantidad_disponible ?? '') }}" >
        </div>

        <div class="form-group">
        <label for="estado">Estado:</label>
        <select name="estado" class="borde-negro"  id="estado" required>
            <option value="Disponible" {{ isset($libros) && $libros->estado == 'Disponible' ? 'selected' : '' }}>Disponible</option>
            <option value="Prestado" {{ isset($libros) && $libros->estado == 'Prestado' ? 'selected' : '' }}>Prestado</option>
            <option value="No disponible" {{ isset($libros) && $libros->estado == 'No disponible' ? 'selected' : '' }}>No disponible</option>
        </select>
        </div>

        <div class="butones">
            <button type="submit" name="accion" value="guardar">📘 Guardar Libro</button>
            <button type="submit" name="accion" value="consultar">🔍 Consultar Libro</button>
            <button type="submit" name="accion" value="modificar">✏️ Modificar Libro</button>
            <button type="submit" name="accion" value="eliminar">🗑️ Eliminar Libro</button>
        </div>
    </form>

    <br>
   <a href="{{ route('devoluciones.index') }}" class="enlace-volver">🔙 Ver listado de Devoluciones</a>


    <script>
        $(document).ready(function() {
            $('#consultar').on('click', function() {
                var titulo = $('#titulo').val();
                var autor = $('#autor').val();

                $.ajax({
                    url: '{{ route('libro.consultarAjax') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        titulo: titulo,
                        autor: autor
                    },
                    success: function(response) {
                        if (response.error) {
                            alert(response.error);
                        } else {
                            
                            $('#editorial').val(response.editorial);
                            $('#anio_publicacion').val(response.anio_publicacion);
                            $('#genero').val(response.genero);
                            $('#clasificacion_tematica').val(response.clasificacion_tematica);
                            $('#cantidad_disponible').val(response.cantidad_disponible);
                            $('#estado').val(response.estado);
                        }
                    },
                    error: function() {
                        alert('Ocurrió un error al consultar el libro.');
                    }
                });
            });
        });
    </script>
</body>
</html>
@endsection
