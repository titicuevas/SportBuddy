<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto SportBuddy</title>
</head>
<body style="font-family: sans-serif; line-height: 1.5; color: #111;">
    <h1 style="font-size: 1.25rem;">Nuevo contacto desde SportBuddy</h1>

    <p>Un usuario autenticado ha solicitado contacto:</p>

    <ul>
        <li><strong>Nombre:</strong> {{ $user->name }} {{ $user->apellidos }}</li>
        <li><strong>Correo electrónico:</strong> {{ $user->email }}</li>
        @if ($user->telefono)
            <li><strong>Teléfono:</strong> {{ $user->telefono }}</li>
        @endif
        <li><strong>Usuario ID:</strong> {{ $user->id }}</li>
    </ul>

    <p style="color: #555; font-size: 0.875rem;">
        Puedes responder directamente a este correo; el remitente de respuesta es el email del usuario.
    </p>
</body>
</html>
