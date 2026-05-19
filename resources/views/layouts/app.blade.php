<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Farmacia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand" href="/">
            Farmacia
        </a>

        <div class="navbar-nav align-items-center">

            <a class="nav-link" href="/">Inicio</a>

            <a class="nav-link" href="/nosotros">
                Nosotros
            </a>

            <a class="nav-link" href="/catalogo">
                Catálogo
            </a>

            <a class="nav-link" href="/contacto">
                Contacto
            </a>

            <a class="nav-link" href="/carrito">

                🛒 Carrito
                ({{ count(session('carrito', [])) }})

            </a>

            @if(session('token'))

                <a class="nav-link" href="/perfil">
                    Perfil
                </a>

                <a class="nav-link" href="/logout">
                    Logout
                </a>

                <a class="nav-link" href="/pedidos">
                    Mis pedidos
                </a>

                @if(session('usuario'))

                    <img src="{{ session('usuario')['imagen'] ?? 'https://via.placeholder.com/40' }}"
                         width="40"
                         height="40"
                         class="rounded-circle ms-2">

                @endif

            @else

                <a class="nav-link" href="/login">
                    Login
                </a>

                <a class="nav-link" href="/registro">
                    Registro
                </a>

            @endif

        </div>

    </div>

</nav>

<div class="container mt-4">

    @yield('content')

</div>

<footer class="bg-dark text-white text-center p-3 mt-5">

    Farmacia © 2026

</footer>

</body>
</html>