<x-app-layout>
    <x-slot name="header">
        <div class="profile-page-intro">
            <div class="profile-intro-main">
                @if ($user->avatar_path)
                    <img class="profile-intro-avatar" src="{{ asset('storage/'.$user->avatar_path) }}" alt="{{ $user->full_name }} profile photo">
                @else
                    <span class="profile-intro-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M20 21a8 8 0 0 0-16 0M12 13a5 5 0 1 0 0-10 5 5 0 0 0 0 10Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                @endif
                <div>
                    <p class="profile-intro-eyebrow">{{ __('Account settings') }}</p>
                    <h1>{{ __('Profile & Security') }}</h1>
                    <p>{{ __('Manage your personal details, password, and account access.') }}</p>
                </div>
            </div>
            <span class="profile-intro-badge">{{ __('SECURE SETTINGS') }}</span>
        </div>
    </x-slot>

    @include('profile.partials.update-profile-information-form')

    <div class="profile-settings-grid">
        <div class="profile-settings-main">
            @include('profile.partials.update-password-form')
        </div>
        <aside class="profile-settings-sidebar">
            @include('profile.partials.delete-user-form')
        </aside>
    </div>
</x-app-layout>
