<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sign-up-in.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    {{-- @vite('resources/css/app.css') --}}
    <title>{{ env('APP_NAME') }} | @yield('tittle', 'Default')</title>
</head>

<body>
    <header>
        @section('header')
            @include('generals.nav')
        @show
    </header>
    <main>
        @yield('main')
    </main>
    <footer>
        <p>Copyright: <span id="current-year"></span></p>
    </footer>
    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script> {{-- En produccion quitar cdn tailwind --}}
</body>

</html>
