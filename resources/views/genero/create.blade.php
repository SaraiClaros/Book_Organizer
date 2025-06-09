@extends('layouts.navigation')

@section('title', 'Historial - Biblioteca')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Género</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

</head>
<body>
    <h1 style="color: #DAF7A6 ;">Registrar Nuevo Género</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="form-genero" action="{{ route('genero.store') }}" method="POST">
        @csrf
         <input type="hidden" id="genero_id" name="genero_id" value=""> 

        <label for="genero">Nombre del Género:</label>
        <input type="text" name="genero" id="genero" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea name="descripcion" id ="descripcion" rows="4" cols="50"></textarea><br><br>
 
        <div class="butones">
        <button type="submit">Guardar Generos </button>
        <button type="button" id="consultar">Consultar Generos</button>
        <button type="button" id="modificar">Modificar Generos</button>
        <button type="submit">Eliminar Generos</button>
        </div>
       
    </form>

    <br>
    <a href="{{ route('genero.index') }}">🔙 Ver géneros registrados</a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
     <script>
    $(document).ready(function () {
        $('#consultar').on('click', function () {
            var genero = $('#genero').val();

            $.ajax({
                url: '{{ route('genero.consultar') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    genero: genero,
                },
                success: function (response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        $('#descripcion').val(response.descripcion);
                        $('#genero_id').val(response.id);
                    }
                },
                error: function () {
                    alert('Ocurrió un error al consultar el género.');
                }
            });
        });

        $('#modificar').on('click', function () {
            let id = $('#genero_id').val();

            if (!id) {
                alert('Primero debes consultar un género existente.');
                return;
            }

            let form = $('#form-genero');
            form.attr('action', '/genero/' + id);

            
            if ($('input[name="_method"]').length === 0) {
                form.append('<input type="hidden" name="_method" value="PUT">');
            }

            form.submit();
        });
    });
</script>

</body>
</html>
@endsection