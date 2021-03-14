<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="p-4 pt-5">
            @auth
                <img src="{{ auth()->user()->avatar }}" class="img logo rounded-circle mb-5" alt=""/>
            @endauth

            <ul class="list-unstyled components mb-5">
                @auth
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-link">Logout</button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('discord.redirect') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <div id="content" class="p-4 p-md-5">
        <nav class="navbar navbar-expand lg navbar-dark bg-dark rounded">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </nav>
    </div>
</div>

@includeWhen(session('error'), 'includes.alert', ['type' => 'danger', 'message' => session('error')])
@includeWhen(session('notice'), 'includes.alert', ['type' => 'success', 'message' => session('notice')])

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
