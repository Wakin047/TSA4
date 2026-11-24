@extends('layouts.tasks')

@section('title', $task->title.' | Tasks for Today')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Task details</p>
            <h1>{{ $task->title }}</h1>
            <p class="page-description">Created {{ $task->created_at->format('M j, Y') }}</p>
        </div>
        <a class="button button-secondary" href="{{ route('tasks.index') }}">Back to tasks</a>
    </div>

    <section class="panel detail-panel">
        <div class="detail-topline">
            <span class="status-badge status-{{ $task->status }}">{{ \App\Models\Task::STATUSES[$task->status] }}</span>
            <span class="detail-due">Due {{ $task->due_date?->format('M j, Y') ?? 'date not set' }}</span>
        </div>
        <h2>Description</h2>
        <p class="detail-description">{{ $task->description ?: 'No description provided.' }}</p>
        @auth
            <div class="form-actions">
                <a class="button button-primary" href="{{ route('tasks.edit', $task) }}">Edit task</a>
                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                    @csrf
                    @method('DELETE')
                    <button class="button button-secondary" type="submit">Archive task</button>
                </form>
                <form method="POST" action="{{ route('tasks.delete', $task) }}" onsubmit="return confirm('Permanently delete this task? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button class="button button-danger" type="submit">Delete task</button>
                </form>
            </div>
        @endauth
    </section>
@endsection
