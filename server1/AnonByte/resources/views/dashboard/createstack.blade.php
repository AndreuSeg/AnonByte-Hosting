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
    <div class="stack-form w-full pt-4">
        <form class="gap-4" method="POST" action="{{ route('create-stack') }}">
            @csrf
            <div class="container serverweb">
                <h1>Nginx</h1>
                <div class="textbox">
                    <label class="mt-2 ml-2" for="app_name">Nombre de la app o proyecto</label>
                    <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="text" name="app_name" placeholder="Nombre de la app">
                    <label class="mt-2 ml-2" for="zip_file_app">Zip con la app dentro</label>
                    <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="file" name="app_name" placeholder="Zip file">
                </div>
            </div>
            <div class="container mysql">
                <h1>Mysql</h1>
                <div class="textbox">
                    <label class="mt-2 ml-2" for="database_name">Nombre BD</label>
                    <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="text" name="database_name" placeholder="Nombre de la BD">
                    <label class="mt-2 ml-2" for="user_mysql">Mysql User</label>
                    <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="text" name="user_mysql" placeholder="Usuario Mysql">
                    <label class="mt-2 ml-2" for="user_password_mysql">Mysql User Password</label>
                    <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="password" name="user_password_mysql" placeholder="Contraseña usuario">
                    <label class="mt-2 ml-2" for="root_password">Root Password</label>
                    <input class="pt-2 pb-2 pl-4 pr-4 rounded" type="password" name="root_password" placeholder="Contraseña root">
                </div>
            </div>
            <button class="create-stack-button text-center p-3 rounded w-40" type="submit">Create Stack</button>
        </form>
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
    <script src="https://cdn.tailwindcss.com"></script> {{-- En produccion quitar cdn tailwind --}}
</body>

</html>
