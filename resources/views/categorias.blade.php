@extends('layouts.navigation')

@section('title', 'Categorias')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Categorías</title>
    <style>
            body {
       background-image: url('/imagenes/libr.png');
       margin: 0;
       background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        
    }

    

        .categoria-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr); 
            gap: 15px; 
            max-width: 1500px;
            
            
        }
        .categoria-btm {
            width: 100%; 
            height: 150px;
            background-color: rgb(36, 30, 45);
            color:rgb(242, 237, 237);
            font-size: 28px;
            font-weight: bold;
            border-radius: 10px;
            border: none;
            cursor: pointer;

            
            display: flex;
            justify-content: center;
            align-items: center;

            text-align: center;
        }
        a {
            text-decoration: none; 
        }

        
    </style>
</head>
<body>
    <h1 style="
    text-align: center;
    font-size: 48px;
    color: white;
    background-color: black;
    padding: 15px 0;
    width: 100%;
    margin: 30px 0; /* espacio arriba y abajo */
    box-sizing: border-box;
">
    Categorías
</h1>



    <div class="categoria-container">
        @foreach($categorias as $categoria)
            <a href="{{ route('categoria.pdfs', ['id' => $categoria->id]) }}">
                <button class="categoria-btm">
                    {{ $categoria->nombre }}
                </button>
            </a>
        @endforeach
    </div>

</body>
</html>
@endsection