<section class="panel form-panel">
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="form-grid">
            <div class="form-field">
                <label for="full_name">Full name <span class="required">*</span></label>
                <input id="full_name" name="full_name" type="text" value="{{ old('full_name', $user->full_name ?? '') }}" maxlength="255" required autofocus>
                @error('full_name') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <label for="username">Username <span class="required">*</span></label>
                <input id="username" name="username" type="text" value="{{ old('username', $user->username ?? '') }}" maxlength="255" required>
                @error('username') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <label for="email">Login email @if (!isset($user)) <span class="required">*</span> @endif</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email ?? '') }}" maxlength="255" @if (!isset($user)) required @endif>
                @if (isset($user))
                    <span class="field-hint">Required when setting or changing a password.</span>
                @endif
                @error('email') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <label for="password">
                    {{ isset($user) ? 'New password' : 'Password' }}
                    @if (!isset($user)) <span class="required">*</span> @endif
                </label>
                <input id="password" name="password" type="password" autocomplete="new-password" @if (!isset($user)) required @endif>
                @if (isset($user))
                    <span class="field-hint">Leave blank to keep the current password.</span>
                @endif
                @error('password') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <label for="password_confirmation">
                    {{ isset($user) ? 'Confirm new password' : 'Confirm password' }}
                    @if (!isset($user)) <span class="required">*</span> @endif
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" @if (!isset($user)) required @endif>
                @error('password_confirmation') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field form-field-wide">
                <label for="avatar">Avatar</label>
                @if (isset($user) && $user->avatar_path)
                    <div class="current-image">
                        <img src="{{ asset('storage/'.$user->avatar_path) }}" alt="{{ $user->full_name }} avatar">
                        <span>Current avatar</span>
                    </div>
                @endif
                <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                <span class="field-hint">JPG, PNG, or WebP. Maximum file size: 2 MB.</span>
                @error('avatar') <p class="field-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-actions">
            <a class="button button-secondary" href="{{ route('users.index') }}">Cancel</a>
            <button class="button button-primary" type="submit">{{ $buttonLabel }}</button>
        </div>
    </form>
</section>
