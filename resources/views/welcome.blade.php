<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | BlueCart</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
</head>
<body class="landing-page">
    @include('partials.marketing-navigation', ['activePage' => 'home'])

    <main class="marketing-main">
        <section class="marketing-hero" aria-labelledby="home-title">
            <div class="marketing-copy">
                <p class="marketing-eyebrow">A calmer way to run your records</p>
                <h1 id="home-title">Your store team, <span>in good order.</span></h1>
                <p class="marketing-description">
                    BlueCart brings customer details and staff accounts into one clear workspace,
                    so everyday updates feel simple and secure.
                </p>
                <div class="marketing-actions">
                    @auth
                        <a class="marketing-button marketing-button-primary" href="{{ route('users.index') }}">Open user directory</a>
                        <a class="marketing-button marketing-button-secondary" href="{{ route('customers.index') }}">View customers</a>
                    @else
                        <a class="marketing-button marketing-button-primary" href="{{ route('login') }}">Sign in to BlueCart</a>
                        <a class="marketing-button marketing-button-secondary" href="{{ route('about') }}">Explore the workspace</a>
                    @endauth
                </div>
                <p class="marketing-note"><span aria-hidden="true"></span>Built for clear records and confident updates.</p>
            </div>

            <div class="workspace-card" aria-label="BlueCart workspace preview">
                <div class="workspace-topbar">
                    <span class="workspace-brand-dot" aria-hidden="true">B</span>
                    <span>BlueCart workspace</span>
                    <span class="workspace-status">READY</span>
                </div>
                <div class="workspace-welcome">
                    <p>YOUR MANAGEMENT SPACE</p>
                    <h2>Good day,<br>let’s get organized.</h2>
                </div>
                <div class="workspace-summary">
                    <div class="workspace-summary-item">
                        <span class="summary-icon summary-icon-blue" aria-hidden="true">C</span>
                        <span><small>DIRECTORY</small><strong>Customer records</strong></span>
                        <span class="summary-arrow" aria-hidden="true">&rarr;</span>
                    </div>
                    <div class="workspace-summary-item">
                        <span class="summary-icon summary-icon-mint" aria-hidden="true">U</span>
                        <span><small>TEAM</small><strong>User accounts</strong></span>
                        <span class="summary-arrow" aria-hidden="true">&rarr;</span>
                    </div>
                </div>
                <div class="workspace-footer">
                    <span>One workspace</span>
                    <span>Thoughtful by design</span>
                </div>
            </div>
        </section>

        <section class="home-benefits" aria-label="BlueCart benefits">
            <article class="home-benefit">
                <p class="benefit-label">CUSTOMERS</p>
                <h2>Details in one place</h2>
                <p>Keep customer names and contact information easy to find and update.</p>
            </article>
            <article class="home-benefit">
                <p class="benefit-label">TEAM</p>
                <h2>Access with purpose</h2>
                <p>Staff sign in with their own accounts to manage protected records.</p>
            </article>
            <article class="home-benefit">
                <p class="benefit-label">UPDATES</p>
                <h2>Changes made clearly</h2>
                <p>Use straightforward forms to create, review, and maintain information.</p>
            </article>
        </section>

        <section class="home-about-callout">
            <div>
                <p class="marketing-eyebrow">A closer look at BlueCart</p>
                <h2>Simple tools. A more confident workflow.</h2>
            </div>
            <a class="marketing-button marketing-button-light" href="{{ route('about') }}">Discover what it does <span aria-hidden="true">&rarr;</span></a>
        </section>
    </main>

    @include('partials.marketing-footer')
</body>
</html>
