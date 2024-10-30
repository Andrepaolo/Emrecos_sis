<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EMRECOS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* Estilos del fondo */
        body {
            background-image: url('/imagenes/fondo2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100vw;
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Ajustes adicionales para dispositivos móviles */
        @media (max-width: 768px) {
            body {
                background-size: contain; /* Ajusta la imagen en pantallas pequeñas */
                height: auto; /* Permite que el contenido defina la altura en lugar de fijar 100vh */
            }
        }

        /* Estilos para los botones de autenticación */
        .auth-buttons {
            display: flex;
            gap: 20px;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .auth-buttons a {
            padding: 10px 20px;
            background-color: yellow;
            color: black;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .auth-buttons a:hover {
            background-color: darkgreen;
        }
    </style>
</head>

<body>
    <div class="auth-buttons">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Iniciar sesión</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Registrarse</a>
                @endif
            @endauth
        @endif
    </div>
</body>

</html>
