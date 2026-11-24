<x-guest-layout>
    <form class="auth-form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="auth-field">
            <label for="username">Username</label>
            <input class="auth-input" id="username" name="username" type="text" value="{{ old('username') }}" required autofocus autocomplete="username">
            @error('username') <p class="auth-error" role="alert">{{ $message }}</p> @enderror
        </div>

        <div class="auth-field">
            <label for="full_name">Full name</label>
            <input class="auth-input" id="full_name" name="full_name" type="text" value="{{ old('full_name') }}" required autocomplete="name">
            @error('full_name') <p class="auth-error" role="alert">{{ $message }}</p> @enderror
        </div>

        <div class="auth-field">
            <label for="email">Email address</label>
            <input class="auth-input" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email') <p class="auth-error" role="alert">{{ $message }}</p> @enderror
        </div>

        <div class="auth-field">
            <label for="password">Password</label>
            <input class="auth-input" id="password" name="password" type="password" required autocomplete="new-password">
            @error('password') <p class="auth-error" role="alert">{{ $message }}</p> @enderror
        </div>

        <div class="auth-field">
            <label for="password_confirmation">Confirm password</label>
            <input class="auth-input" id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
            @error('password_confirmation') <p class="auth-error" role="alert">{{ $message }}</p> @enderror
        </div>

        <button class="auth-submit" type="submit">Create account <span aria-hidden="true">→</span></button>
    </form>

    <p class="auth-switch">Already registered? <a href="{{ route('login') }}">Sign in</a></p>
</x-guest-layout>
