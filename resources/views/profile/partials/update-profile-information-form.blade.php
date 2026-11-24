<section class="panel profile-section">
    <header class="panel-heading">
        <div>
            <h2>{{ __('Profile Information') }}</h2>
            <p>{{ __("Update your account's profile information and email address.") }}</p>
        </div>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="form-panel profile-form" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="profile-avatar-editor">
            <div class="profile-avatar-preview">
                @if ($user->avatar_path)
                    <img src="{{ asset('storage/'.$user->avatar_path) }}" alt="{{ $user->full_name }} profile photo">
                @else
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M20 21a8 8 0 0 0-16 0M12 13a5 5 0 1 0 0-10 5 5 0 0 0 0 10Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                @endif
            </div>
            <div class="form-field profile-avatar-fields">
                <x-input-label for="avatar" :value="__('Profile photo')" />
                <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                <p class="profile-avatar-help">{{ __('JPG, PNG, or WebP. Maximum file size: 2 MB.') }}</p>
                <x-input-error :messages="$errors->get('avatar')" />
            </div>
        </div>

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
        </div>
    </form>
</section>
