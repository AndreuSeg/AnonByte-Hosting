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
    <div class="over">
        <div class="explicacion mt-6 gap-8 pl-6 pr-6">
            <div class="tittle">
                <h1 class="text-4xl text-center">Para poder acceder a todos nuestros servicios tendras que crear tu
                    stack
                    primero.<br><b>Importante</b> leer esto!</h1>
            </div>
            <div class="consejos gap-4">
                <div class="consejo p-2 bg-slate-300 rounded">
                    <h2 class="text-2xl">1r Paso:</h2>
                    <h3>
                        Nginx o Apache:<br>
                        Tienes que decidir entre si quieres usar Nginx como servidor web o si quieres apache.
                        Diferencias clave entre ellos:
                        <ul>
                            <li class="ml-5"><b>Arquitectura:</b> La arquitectura de Nginx está diseñada para manejar
                                un gran número de conexiones simultáneas con recursos limitados, mientras que
                                Apache está diseñado para manejar menos conexiones con más recursos.
                            </li>
                            <li class="ml-5">
                                <b>Rendimiento:</b> Nginx es conocido por su alta capacidad de procesamiento y
                                rendimiento, especialmente en situaciones de alta carga de tráfico, mientras que
                                Apache tiene un rendimiento inferior en comparación con Nginx.
                            </li>
                            <li class="ml-5">
                                <b>Configuración:</b> Apache tiene una configuración más compleja y requiere más tiempo
                                para
                                configurar y personalizar, mientras que Nginx tiene una configuración más simple y
                                flexible.
                            </li>
                            <li class="ml-5">
                                <b>Módulos:</b> Apache tiene una amplia variedad de módulos disponibles para extender
                                sus funcionalidades, mientras que Nginx tiene una selección más limitada de módulos.
                            </li>
                            <li class="ml-5">
                                <b>Uso de recursos:</b> Nginx utiliza menos recursos del sistema (como memoria RAM)
                                que Apache, lo que lo hace más adecuado para servidores con recursos limitados.
                            </li>
                            <li class="ml-5">
                                <b>Soporte para lenguajes de programación:</b> Apache tiene un soporte completo
                                para varios lenguajes de programación, como PHP, Perl y Python,
                                mientras que Nginx requiere un servidor proxy para manejar estos lenguajes.
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="consejo p-2 bg-slate-300 rounded">
                    <h2 class="text-2xl">2r Paso:</h2>
                    <h3>
                        Mysql<br>
                        Para crear tu base de datos correctamente necesitamos:
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
                    </h3>
                </div>
                <div class="consejo p-2 bg-slate-300 rounded">
                    <h2 class="text-2xl">3r Paso:</h2>
                    <h3>
                        Php<br>
                        Para que puedas usar tanto apache como nginx neceitaras tener un contenedor de php.
                        Nosotros vamos a proporcionar el dockerfile para crear la imagen correcta para la applicacion
                        que vamos a hostear.
                    </h3>
                </div>
                <div class="consejo p-2 bg-slate-300 rounded">
                    <h2 class="text-2xl">4r Paso:</h2>
                    <h3>
                        PhpMyadmin<br>
                        Igual que con php nosotros vamos a proporcionar un PhpMyAdmin instalado corretamente para poder
                        administrar la base de datos previamente creada.
                    </h3>
                </div>
            </div>
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
