<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Verificar correo electrónico</title>
</head>

<body>
    <h1>Verificación de correo electrónico</h1>
    <p>Bienvenido a AnonByte</p>
    <p>Gracias por registrarte</p>
    <b><a href="{{ route('verify-mail', $id['id']) }}">Verificar correo electrónico</a></b>
    <p>¡Gracias!</p>
</body>

</html>
