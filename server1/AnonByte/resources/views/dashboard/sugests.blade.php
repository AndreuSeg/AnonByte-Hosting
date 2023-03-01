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
    <title>{{ env('APP_NAME') }} | @yield('tittle', 'Sugests')</title>
</head>

<body>
    <div class="over">
        <div class="explicacion mt-6 gap-8 pl-6 pr-6">
            <div class="tittle">
                <h1 class="text-4xl text-center">Para poder acceder a todos nuestros servicios tendras que crear tu
                    stack primero.<br><b>Importante</b> leer esto!</h1>
            </div>
            <div class="consejos gap-4">
                <div class="consejo p-2 bg-slate-300 rounded">
                    <h2 class="text-2xl">1r Paso:</h2>
                    <h3>Nginx</h3>
                    <p>Utilizamos Nginx por sus caracteristicas.</p>
                    <ul>
                        <li class="ml-5"><b>Mayor rendimiento</b></li>
                        <li class="ml-5"><b>Escalabilidad</b></li>
                        <li class="ml-5"><b>Funcionalidades avanzadas</b></li>
                        <li class="ml-5"><b>Configuracion sencilla</b></li>
                    </ul>
                    <p>Información que nos tendras que proporcionar:</p>
                    <ul>
                        <li class="ml-5"><b>Nombre de la app</b></li>
                        <li class="ml-5"><b>Zip con la carpeta con la app dentro</b></li>
                    </ul>
                </div>
                <div class="consejo p-2 bg-slate-300 rounded">
                    <h2 class="text-2xl">2r Paso:</h2>
                    <h3>Mysql</h3>
                    <p>Para crear tu base de datos correctamente necesitamos:</p>
                    <ul>
                        <li class="ml-5">
                            <b>Contraseña:</b> Tanto de root como de un usuario que vas a crear.
                            Esta contraseña va a estar encriptada en nuestra base de datos, y nadie mas que usted
                            va a poder acceder a ella.
                        </li>
                        <li class="ml-5">
                            <b>Nombre de la base de datos:</b> Sin un nombre no se va a crear correctamente.
                        </li>
                        <li class="ml-5">
                            <b>Nombre de usuario</b> Tanto de root como de un usuario creado por usted.
                        </li>
                    </ul>
                </div>
            </div>
            <a href="{{ route('create-stack') }}" class="flex flex-col items-center justify-center">
                <button class="form-stack text-white p-3 rounded w-48" type="submit">Ir a crear el stack</button>
            </a>
        </div>
        <footer>
            <p>Copyright: <span id="current-year"></span></p>
        </footer>
    </div>
    <script src="{{ asset('js/index.js') }}"></script>
    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    {{-- Fin --}}
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
