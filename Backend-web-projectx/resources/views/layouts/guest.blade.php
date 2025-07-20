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
        <div class="auth-container">
            <div class="auth-logo">
                <a href="/">
                    <h1>📚 BookShop</h1>
                </a>
            </div>

            <div class="auth-form">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>