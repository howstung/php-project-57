<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('main.title') }}</title>

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    </head>

    <body class="min-vh-100 d-flex flex-column">

        <!-- Menu -->
        @include('layouts.menu')

        <!-- Page Content -->
        <main class="flex-grow-1">
            <div class="container mt-3" style="margin-top: 50px !important;">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        @include('layouts.footer')

    </body>
</html>
