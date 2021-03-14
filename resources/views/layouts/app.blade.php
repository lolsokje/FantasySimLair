<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        @guest
            <a href="{{ route('discord.redirect') }}" class="btn btn-primary text-white"><i
                        class="fab fa-discord fa-lg"></i> Login</a>
        @else
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        @endguest
    </div>
</nav>

@includeWhen(session('error'), 'includes.alert', ['type' => 'danger', 'message' => session('error')])
@includeWhen(session('notice'), 'includes.alert', ['type' => 'success', 'message' => session('notice')])

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
