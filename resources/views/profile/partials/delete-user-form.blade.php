<section class="panel profile-section profile-delete-section">
    <header class="panel-heading">
        <div>
            <h2>{{ __('Delete Account') }}</h2>
            <p>{{ __('Permanently remove your account and its data.') }}</p>
        </div>
    </header>

    <div class="profile-delete-content">
        <p>{{ __('Before deleting your account, make sure you have saved any information you want to keep.') }}</p>

        <x-danger-button
            class="button button-danger"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >{{ __('Delete Account') }}</x-danger-button>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6 profile-delete-modal">
                @csrf
                @method('delete')

                <h2>{{ __('Are you sure you want to delete your account?') }}</h2>

                <p>{{ __('This action cannot be undone. Enter your password to confirm.') }}</p>

                <div class="form-field">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="current-password"
                    />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="form-actions profile-form-actions">
                    <x-secondary-button class="button button-secondary" x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="button button-danger">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>
</section>
