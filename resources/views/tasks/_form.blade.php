<section class="panel form-panel">
    <form action="{{ $action }}" method="POST">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="form-grid">
            <div class="form-field form-field-wide">
                <label for="title">Task title <span class="required">*</span></label>
                <input id="title" name="title" type="text" value="{{ old('title', $task->title) }}" maxlength="180" required autofocus>
                @error('title') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field form-field-wide">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5" maxlength="5000">{{ old('description', $task->description) }}</textarea>
                @error('description') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <label for="due_date">Due date</label>
                <input id="due_date" name="due_date" type="date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">
                @error('due_date') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <label for="status">Status <span class="required">*</span></label>
                <select id="status" name="status" required>
                    @foreach (\App\Models\Task::STATUSES as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $task->status ?: 'pending') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status') <p class="field-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-actions">
            <a class="button button-secondary" href="{{ route('tasks.index') }}">Cancel</a>
            <button class="button button-primary" type="submit">{{ $buttonLabel }}</button>
        </div>
    </form>
</section>
