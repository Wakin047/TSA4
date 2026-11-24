<header class="landing-header">
    <nav class="landing-nav" aria-label="Main navigation">
        <a class="landing-brand" href="{{ route('home') }}">
            <span class="landing-brand-mark">B</span>
            <span>BlueCart <small>STORE MANAGEMENT</small></span>
        </a>

        <div class="landing-links">
            <a class="{{ $activePage === 'home' ? 'landing-nav-active' : '' }}" href="{{ route('home') }}">Home</a>
            <a class="{{ $activePage === 'about' ? 'landing-nav-active' : '' }}" href="{{ route('about') }}">About</a>
            @guest
                <a href="{{ route('login') }}">Sign in</a>
                <a class="landing-signup" href="{{ route('register') }}">Create account</a>
            @else
                <a href="{{ route('customers.index') }}">Customers</a>
                <a href="{{ route('users.index') }}">Users</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Log out</button>
                </form>
            @endguest
        </div>
    </nav>
</header>
