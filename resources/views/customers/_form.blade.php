<section class="panel form-panel">
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="form-grid">
            <div class="form-field form-field-wide">
                <label for="full_name">Full name <span class="required">*</span></label>
                <input id="full_name" name="full_name" type="text" value="{{ old('full_name', $customer->full_name ?? '') }}" maxlength="255" required autofocus>
                @error('full_name') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <label for="email">Email address <span class="required">*</span></label>
                <input id="email" name="email" type="email" value="{{ old('email', $customer->email ?? '') }}" maxlength="255" required>
                @error('email') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <label for="phone">Phone number <span class="required">*</span></label>
                <input id="phone" name="phone" type="tel" value="{{ old('phone', $customer->phone ?? '') }}" maxlength="30" required>
                @error('phone') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field form-field-wide">
                <label for="avatar">Customer avatar</label>
                @if (isset($customer) && $customer->avatar_path)
                    <div class="current-image">
                        <img src="{{ asset('storage/'.$customer->avatar_path) }}" alt="{{ $customer->full_name }} avatar">
                        <span>Current avatar</span>
                    </div>
                @endif
                <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                <span class="field-hint">JPG, PNG, or WebP. Maximum file size: 2 MB.</span>
                @error('avatar') <p class="field-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-actions">
            <a class="button button-secondary" href="{{ route('customers.index') }}">Cancel</a>
            <button class="button button-primary" type="submit">{{ $buttonLabel }}</button>
        </div>
    </form>
</section>
