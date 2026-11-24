<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tasks for Today')</title>
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
                <a class="{{ request()->routeIs('tasks.*') ? 'active' : '' }}" href="{{ route('tasks.index') }}">Task list</a>
                <a class="{{ request()->routeIs('profile.public') ? 'active' : '' }}" href="{{ route('profile.public') }}">Profile</a>
                <a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                @auth
                    <a href="{{ route('profile.edit') }}">Account</a>
                    <a class="nav-create" href="{{ route('tasks.create') }}">＋ New task</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-button" type="submit">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Sign in</a>
                    <a class="nav-create" href="{{ route('register') }}">Create account</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="page-shell">
        @if (session('status'))
            <div class="alert alert-success" role="status">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>

    <footer class="site-footer">Tasks for Today <span>·</span> Keep your day moving</footer>
</body>
</html>
