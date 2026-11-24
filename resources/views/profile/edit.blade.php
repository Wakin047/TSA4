<x-app-layout>
    <x-slot name="header">
        <div class="page-heading">
            <div>
                <p class="eyebrow">Account settings</p>
                <h1>{{ __('Profile') }}</h1>
                <p class="page-description">Update your account details and security settings.</p>
            </div>
        </div>
    </x-slot>

    <div class="profile-settings-grid">
        <div class="profile-settings-main">
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
        </div>
        <aside class="profile-settings-sidebar">
            @include('profile.partials.delete-user-form')
        </aside>
    </div>
</x-app-layout>
