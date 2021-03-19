<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
</head>
<body>
<div class="wrapper d-flex">
    <nav id="sidebar">
        <div class="p-4 pt-5">
            @auth
                @if (auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" class="img logo rounded-circle mb-5" alt=""/>
                @endif
            @endauth

            <ul class="list-unstyled mb-5">
                <li><a href="{{ route('index') }}"><i class="fas fa-home"></i> Index</a></li>
                @auth
                    @if (auth()->user()->is_admin)
                        <li>
                            <a href="#" data-bs-toggle="collapse" data-bs-target="#adminSubmenu" role="button">
                                <i class="fas fa-user-cog"></i>
                                Admin
                            </a>
                        </li>
                        <ul class="collapse {{ Request::is('admin/*') ? 'show' : '' }}" id="adminSubmenu">
                            <li><a href="{{ route('admin.users') }}"><i class="fas fa-users"></i> Users</a></li>
                            <li><a href="{{ route('admin.channels') }}"><i class="fas fa-hashtag"></i> Channels</a></li>
                            <li><a href="{{ route('admin.championships') }}"><i class="fas fa-trophy"></i> Championships</a>
                            </li>
                        </ul>
                    @endif
                    <li>
                        <a href="{{ route('championships.index') }}"><i class="fas fa-trophy"></i> My championships</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-link">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </button>
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
                @include('includes.breadcrumbs')

                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </nav>

        <div class="mt-5">
            @includeWhen(session('error'), 'includes.alert', ['type' => 'danger', 'message' => session('error')])
            @includeWhen(session('notice'), 'includes.alert', ['type' => 'success', 'message' => session('notice')])

            @yield('content')
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}" defer></script>
@livewireScripts
</body>
</html>
