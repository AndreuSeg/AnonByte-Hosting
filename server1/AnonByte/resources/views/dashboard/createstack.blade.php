<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    {{-- Fin  --}}
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    {{-- @vite('resources/css/app.css') --}}
    <title>{{ env('APP_NAME') }} | @yield('tittle', 'Create Stack')</title>
</head>

<body>
    <div class="stack-form w-full gap-24 p-16">
        <div class="container serverweb">
            <label for="service">Nginx o Apache</label>
            <select class="selectservice w-24" name="service" id="service" onclick="">
                <option class="option" id="nginx" value="nginx">Nginx</option>
                <option class="option" id="apache" value="apache">Apache</option>
            </select>
            <div class="formulario"></div>
        </div>
        <div class="container mysql">Mysql</div>
        <div class="container php">Php</div>
        <div class="container phpmyadmin">PhpMyAdmin</div>
    </div>
    <footer>
        <p>Copyright: <span id="current-year"></span></p>
    </footer>
    <script src="{{ asset('js/index.js') }}"></script>
    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    {{-- Fin --}}
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
