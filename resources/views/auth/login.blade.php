<x-guest-layout>
    @if (session('status'))
        <div class="auth-status" role="status">{{ session('status') }}</div>
    @endif

    <form class="auth-form" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="auth-field">
            <label for="email">Email address</label>
            <input class="auth-input" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email') <p class="auth-error" role="alert">{{ $message }}</p> @enderror
        </div>

        <div class="auth-field">
            <label for="password">Password</label>
            <input class="auth-input" id="password" name="password" type="password" required autocomplete="current-password">
            @error('password') <p class="auth-error" role="alert">{{ $message }}</p> @enderror
        </div>

        <div class="auth-options">
            <label class="auth-remember" for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">Forgot password?</a>
            @endif
        </div>

        <button class="auth-submit" type="submit">Sign in <span aria-hidden="true">→</span></button>
    </form>

    <p class="auth-switch">New to Tasks for Today? <a href="{{ route('register') }}">Create an account</a></p>
</x-guest-layout>
