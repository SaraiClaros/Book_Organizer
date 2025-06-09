<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Biblioteca')</title>
    <link rel="stylesheet" href="{{ asset('css/barra.css') }}">
</head>
<body>

<div class="navbar-container">
    <nav style="display:flex; align-items:center; justify-content:space-between;">
        <div>
            <a href="{{ url('dashboard') }}">🏠 HOME</a>
           <a href="{{ route('categorias') }}">📘 DESCUBRE</a>
            <a href="{{ route('registros') }}">📄 REGISTROS</a>
            <a href="{{ route('nosotros') }}">🤝 NOSOTROS</a>
        </div>

        @auth
        <div class="user-menu" style="position: absolute; top: 10px; right: 10px; z-index: 9999;">
            <div style="position: relative;">
                <button id="dropdownToggle" onclick="toggleDropdown()" 
                    style="background:none; border:none; cursor:pointer; color:white; font-weight:bold; 
                    font-size: 1.2rem; 
                    text-align: center; 
                    padding-top: 8px;  
                    width: 150px; 
                    display: block;">
                    {{ Auth::user()->name }}
                </button>

                <div id="dropdown" style="display:none; position:absolute; top:100%; right:0; background:white; border:1px solid #ccc; padding:0.5rem; box-shadow:0 4px 8px rgba(0,0,0,0.1); min-width:150px; z-index:9999;">
                    <a href="{{ route('profile.edit') }}" style="color:black; text-decoration:none; padding:0.3rem; display: block;">
                        Actualizar Perfil
                    </a>

                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" style="background:none; border:none; padding:0.3rem; cursor:pointer; color:black; width: 100%; text-align: left;">
                            Cerrar sesión
                        </button>
                    </form>
                </div>

            </div>
        </div>
        @endauth
    </nav>

    @isset($header)
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    @endisset
</div>

@yield('content')

<footer>
    📖 Book Organizer {{ date('Y') }}
</footer>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown');
        dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
    }

    window.onclick = function(event) {
        const dropdown = document.getElementById('dropdown');
        const button = document.getElementById('dropdownToggle');
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    }
</script>

</body>
</html>
