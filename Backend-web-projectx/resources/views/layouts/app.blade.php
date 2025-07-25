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
                    <a href="{{ route('start') }}">Start</a>
                    <a href="{{ route('allUsers') }}">All Users</a>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ route('faq.index') }}">FAQ</a>
                    <a href="{{ route('contact_form') }}">Contact Form</a>
                    @auth
                    @if (Auth::user()->admin)
                    <a href="{{ route('addBook') }}">Add Book</a>
                    <a href="{{ route('profiel') }}">Profile</a>
                    <a href="{{ route('faq.admin') }}">addFAQ</a>
                    @endif
                    @endauth


                </div>
                
                <!-- VERIFICAR SI EL USUARIO ESTÁ LOGUEADO -->
                @auth
                    <div class="user-menu">
                        <span>{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-logout">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="user-menu">
                        <a href="{{ route('login') }}" class="btn-login">Login</a>
                        <a href="{{ route('register') }}" class="btn-register">Register</a>
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
                @yield('content2')
            </div>
        </main>

        <footer class="main-footer">
            &copy; {{ date('Y') }} BookShop. Todos los derechos reservados.
        </footer>
    </body>
</html>