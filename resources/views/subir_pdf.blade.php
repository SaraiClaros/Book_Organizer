@extends('layouts.navigation')

@section('title', 'Subir PDF')

@section('content')


<!DOCTYPE html>
<html>
<head>
    <title>Subir PDF</title>
    <style>
        body {
            background-color:rgb(158, 135, 161);
            color: #000000;
            
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border: 1px solid #cccccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 400px;
            margin: 50px auto;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        select, input[type="file"], textarea {
            border: 1px solid #000000;
            padding: 8px;
            background-color: #f5f5f5;
            color: #000000;
            width: 100%;
            box-sizing: border-box;
            margin-top: 5px;
        }

        option {
            color: #000000;
            background-color: #f5f5f5;
        }

        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: #f5f5f5;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 20px;
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <h2>Subir PDF</h2>

        <form action="{{ route('subir.pdf') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="archivo">Archivo PDF:</label>
            <input type="file" name="archivo" id="archivo" accept=".pdf" required>

            <label for="portada">Portada (opcional):</label>
            <input type="file" name="portada" id="portada" accept="image/*">

            <label for="categoria">Categoría:</label>
            <select name="categoria_id" id="categoria" required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4"></textarea>

            <button type="submit">Subir PDF</button>
        </form>

        <div class="message">
            @if(session('exito'))
                <p style="color: green;">{{ session('exito') }}</p>
            @endif

            @if($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
@endsection