<section class="panel profile-section">
    <header class="panel-heading">
        <div>
            <h2>{{ __('Profile Information') }}</h2>
            <p>{{ __("Update your account's profile information and email address.") }}</p>
        </div>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="form-panel profile-form">
        @csrf
        @method('patch')

        <div class="form-grid profile-form-grid">
            <div class="form-field">
                <x-input-label for="full_name" :value="__('Full name')" />
                <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name', $user->full_name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
            </div>

            <div class="form-field">
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('username')" />
            </div>

            <div class="form-field">
                <x-input-label for="email" :value="__('Email address')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>

        <div class="form-actions profile-form-actions">
            <button class="button button-primary" type="submit">{{ __('Save profile') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="profile-saved" role="status">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
