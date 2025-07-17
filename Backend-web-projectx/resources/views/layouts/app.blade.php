<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BookShop') }}</title>

        <!-- CSS clásico -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        <header class="main-header">
            <nav class="main-nav">
                <div class="logo">📚 BookShop</div>
                <div class="nav-links">
                    <a href="{{ route('start') }}">Inicio</a>
                    <a href="{{ route('profiel') }}">Perfil</a>
                    <a href="{{ route('addBook') }}">Agregar Libro</a>
                </div>
                
                <!-- VERIFICAR SI EL USUARIO ESTÁ LOGUEADO -->
                @auth
                    <div class="user-menu">
                        <span>{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-logout">Cerrar Sesión</button>
                        </form>
                    </div>
                @else
                    <div class="user-menu">
                        <a href="{{ route('login') }}" class="btn-login">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="btn-register">Registrarse</a>
                    </div>
                @endauth
            </nav>
        </header>

        <main class="main-content">
            @isset($header)
                <header class="page-header">
                    <h1>{{ $header }}</h1>
                </header>
            @endisset

            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>

        <footer class="main-footer">
            &copy; {{ date('Y') }} BookShop. Todos los derechos reservados.
        </footer>
    </body>
</html>