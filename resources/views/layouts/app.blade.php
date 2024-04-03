<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('views.title') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        {{--@vite(['resources/css/app.css', 'resources/js/app.js'])--}}

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <style>
            h1, h3 {
                font-size: 3rem;
                margin-top:100px;
                margin-bottom: 20px;
            }
            .modal h1 {
                margin: 0px;
            }
            input[type=submit] {
                cursor: pointer;
            }

            a.btn {
                margin: 20px 0;
            }

            .nav a, .nav button{
                color: gray;
            }

            nav a.btn {
                margin: 0 5px 0 0;
            }

            .form-label {
                margin: 15px 0px 5px;
            }

            .p-task-item{
                font-weight: bold;
            }

        </style>
    </head>

    <body class="min-vh-100 d-flex flex-column">

        {{--@include('layouts.navigation')--}}

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
