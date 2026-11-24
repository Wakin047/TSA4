<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tasks for Today')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}?v={{ filemtime(public_path('css/tasks.css')) }}">
</head>
<body>
    <header class="site-header">
        <nav class="navigation" aria-label="Main navigation">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark">T</span>
                <span>Tasks for Today <small>GET THINGS DONE</small></span>
            </a>
            <div class="nav-links">
                <a href="{{ route('tasks.index') }}">Task list</a>
                <a href="{{ route('profile.public') }}">Profile</a>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('profile.edit') }}">Account</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="nav-button" type="submit">Log out</button>
                </form>
            </div>
        </nav>
    </header>

    <main class="page-shell">
        @if (session('status'))
            <div class="alert alert-success" role="status">{{ session('status') }}</div>
        @endif

        @isset($header)
            {{ $header }}
        @endisset

        @if (isset($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </main>

    <footer class="site-footer">Tasks for Today <span>·</span> Keep your day moving</footer>
</body>
</html>
