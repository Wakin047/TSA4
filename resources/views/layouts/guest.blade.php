<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Account | Tasks for Today</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
</head>
<body class="auth-page">
    @php
        $isRegisterPage = request()->routeIs('register');
        $isPasswordPage = request()->routeIs('password.*');
    @endphp

    <main class="auth-shell">
        <aside class="auth-aside">
            <a class="auth-brand" href="{{ route('home') }}" aria-label="Tasks for Today home">
                <span class="auth-brand-mark">T</span>
                <span>Tasks for Today <small>PLANNING WORKSPACE</small></span>
            </a>

            <div class="auth-aside-copy">
                <p class="auth-kicker">A CLEARER WAY TO WORK</p>
                <h1>Your day,<br>in good hands.</h1>
                <p>Sign in to create, update, and organize tasks in one simple workspace.</p>
            </div>

            <p class="auth-aside-footer"><span aria-hidden="true">●</span> A smarter way to manage your store</p>
        </aside>

        <section class="auth-main">
            <div class="auth-heading">
                <p class="auth-eyebrow">{{ $isRegisterPage ? 'GET STARTED' : ($isPasswordPage ? 'ACCOUNT HELP' : 'WELCOME BACK') }}</p>
                <h2>{{ $isRegisterPage ? 'Create your account' : ($isPasswordPage ? 'Reset your password' : 'Sign in to Tasks for Today') }}</h2>
                <p>{{ $isRegisterPage ? 'Set up your team account to get started.' : ($isPasswordPage ? 'Follow the steps below to recover access.' : 'Enter your details to continue to your workspace.') }}</p>
            </div>

            {{ $slot }}
        </section>
    </main>

    <footer class="auth-footer">Tasks for Today <span>·</span> Secure account access</footer>
</body>
</html>
