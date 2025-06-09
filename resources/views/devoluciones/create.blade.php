@extends('layouts.navigation')

@section('title', 'Libro - Biblioteca')

@section('content')

<!-- resources/views/devoluciones/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title >Registrar Devolución</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

   

</head>
<body>
    <h1 style="color: #DAF7A6 ;">Registrar Devolución</h1>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('devoluciones.store') }}" method="POST">
        @csrf

        <div class="form-group">
        <label for="prestamos_id">ID del Préstamo:</label>
        <input type="number" class="borde-negro" id="prestamos_id" name="prestamos_id" required><br><br>
        </div>

        <div class="form-group">
        <label for="fecha_devolucion_real">Fecha de Devolución Real:</label>
        <input type="date" class="borde-negro" id="fecha_devolucion_real" name="fecha_devolucion_real" ><br><br>
        </div>
        
        <div class="form-group">
        <label for="observaciones">Observaciones:</label><br>
        <textarea id="observaciones" name="observaciones" rows="4" cols="50"></textarea><br><br>
        </div>

         <div class="butones">
            <button type="submit" name="accion" value="guardar">📘 Guardar Devoluciones</button>
            <button type="button" id="consultar" name="accion" value="consultar">🔍 Consultar Devoluciones</button>
            <button type="button" id="modificar" name="accion" value="modificar">✏️ Update Devoluciones</button>
            <button type="submit" name="accion" value="eliminar">🗑️ Eliminar Devoluciones</button>
        </div>
        
    </form>

    <br>
     <a href="{{ route('devoluciones.index') }}" class="enlace-volver" >🔙 Ver listado de Devoluciones</a>+
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#modificar').on('click', function() {
    var prestamos_id = $('#prestamos_id').val();
    $('form').attr('action', '/devoluciones/' + prestamos_id);
    $('form').append('@method("PUT")');
    $('form').submit();
});
    </script>
     <script>
        $(document).ready(function() {
            $('#consultar').on('click', function() {
                var prestamos_id = $('#prestamos_id').val();
                

                $.ajax({
                    url: '{{ route('devoluciones.consultar') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        prestamos_id: prestamos_id,
                        
                    },
                    success: function(response) {
                        if (response.error) {
                            alert(response.error);
                        } else {
                            
                            $('#fecha_devolucion_real').val(response.fecha_devolucion_real);
                            $('#observaciones').val(response.observaciones);
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