<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font "Poppins" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,100..900;1,100..900&family=Jim+Nightshade&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Reference to CSS/JS -->
    @vite(['resources/css/app.css', $script])
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
    <body>
        @guest
            <nav class="not-logged-in">
                <a href="/">Home</a>
                <a href="{{ route('login') }}">Log-in</a>
            </nav>
        @endguest
        @auth
            <nav class="logged-in">
                <h1>Welkom, {{ Auth::user()->name }}</h1>
                    <div class="flex-logged-in">
                        <a href="/">Home</a>
                        @cannot('admin-access')
                        <a href="{{ route('reviews.index') }}">Mijn Reviews</a>
                        <a href="{{ route('profile.edit') }}">Account</a>
                        @endcannot
                        <form method="POST" action="{{ route('logout') }}" style="text-decoration: none">
                            @csrf
                            <button type="submit">
                                Uitloggen
                            </button>
                        </form>
                    </div>
            </nav>
        @endauth

        {{ $slot }}
    </body>
</html>
