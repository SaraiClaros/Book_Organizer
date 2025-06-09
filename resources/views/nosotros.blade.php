@extends('layouts.navigation')

@section('title', 'Inicio - Biblioteca')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nosotros - Book Organizer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color:rgb(181, 193, 217);
            color: #333;
           
        }
        h1 {
            color: #4b5563;
            margin-bottom: 10px;
        }
        p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        blockquote {
            font-style: italic;
            color: #6b7280;
            border-left: 4px solid #8b5cf6;
            padding-left: 15px;
            margin: 20px 0;
            background: #ede9fe;
            border-radius: 5px;
        }
        .emoji {
            font-size: 1.3rem;
            margin-right: 6px;
        }
    </style>
</head>
<body>
    <h1>📚 Nosotros</h1>
    <p>
        Bienvenido a <strong>Book Organizer</strong> 📖, una opción genial para los amantes de la lectura y la gestión bibliotecaria. Nuestro sistema te permite clasificar tus libros fácilmente por categorías, facilitando la organización y acceso rápido a tus títulos favoritos.
    </p>
    <p>
        Book Organizer es un sistema de gestión bibliotecaria diseñado para simplificar la administración de tus colecciones, permitiendo una experiencia ordenada y eficiente. Ya sea que tengas una pequeña biblioteca personal o una gran colección, nuestra plataforma te ayuda a mantener todo bajo control. 🗂️✨
    </p>

    <blockquote>
        <span class="emoji">🌟</span> "Un libro es un sueño que tienes en tus manos." – Neil Gaiman
    </blockquote>

    <blockquote>
        <span class="emoji">📖</span> "Leer es soñar con los ojos abiertos." – Anónimo
    </blockquote>

    <blockquote>
        <span class="emoji">💡</span> "Los libros son el transporte hacia mundos infinitos." – Desconocido
    </blockquote>

    <p>
        ¡Explora, organiza y disfruta de tus libros con <strong>Book Organizer</strong>! 🚀
    </p>
</body>
</html>
@endsection