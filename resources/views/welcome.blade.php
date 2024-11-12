<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <div class="min-h-screen bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('images/fondo2.jpg') }}')">
        <div class="relative min-h-screen">
            <div class="w-full max-w-7xl mx-auto px-6">
                <header class="flex justify-between items-center py-6">
                    <!-- El resto del contenido permanece igual -->
                    <div class="flex justify-center"></div>
                    <nav class="flex gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/home') }}"
                                    class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-black rounded-md transition-colors border-2 border-yellow-500">Home</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-black rounded-md transition-colors border-2 border-yellow-500">Inicio Sesion</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-black rounded-md transition-colors border-2 border-yellow-500">Registrar</a>
                                @endif
                            @endauth
                        @endif
                    </nav>
                </header>
            </div>
        </div>
    </div>
</body>

</html>
