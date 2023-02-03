<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} | @yield('tittle', 'Default')</title>
</head>

<body>
    <h1>Bienvenido a AnonByte</h1>
    <h3>Gracias por registrarte</h3>
    <a href="{{ route('verify-mail', $id['id']) }}">Verificar correo electrónico</a>
</body>

</html>
