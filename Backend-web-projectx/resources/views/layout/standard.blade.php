<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>BookShop</title>
</head>
<body>
    <header class="main-header">
        <nav class="main-nav">
            <div class="logo">📚 BookShop</div>
            <div class="nav-links">
                <a href="Welcome">Inicio</a>
                <a href="profiel">Perfil</a>
                <a href="test">Test</a>
            </div>
        </nav>
    </header>
    <main class="main-content">
        @yield('content')
        <h1>hola</h1>
    </main>
    <footer class="main-footer">
        &copy; {{ date('Y') }} BookShop. Todos los derechos reservados.
    </footer>
</body>
</html>