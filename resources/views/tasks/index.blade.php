@extends('layouts.tasks')

@section('title', 'Task list | Tasks for Today')

@section('content')
    <section class="page-heading">
        <div>
            <p class="eyebrow">Your shared task board</p>
            <h1>Tasks for today</h1>
            <p class="page-description">A clear view of what is next, in progress, and done.</p>
        </div>
        @auth
            <a class="button button-primary" href="{{ route('tasks.create') }}">＋ Create task</a>
        @else
            <a class="button button-primary" href="{{ route('login') }}">Sign in to manage tasks</a>
        @endauth
    </section>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>Task list</h2>
                <p>{{ $tasks->total() }} {{ \Illuminate\Support\Str::plural('task', $tasks->total()) }} · Archived tasks are hidden</p>
            </div>
        </div>

        @if ($tasks->isEmpty())
            <div class="empty-state">
                <span class="empty-icon" aria-hidden="true">✓</span>
                <h3>No active tasks yet</h3>
                <p>Sign in to add the first task to this list.</p>
                @guest
                    <a class="button button-primary" href="{{ route('login') }}">Sign in</a>
                @else
                    <a class="button button-primary" href="{{ route('tasks.create') }}">Create your first task</a>
                @endguest
            </div>
        @else
            <div class="task-list">
                @foreach ($tasks as $task)
                    <article class="task-card">
                        <div class="task-card-main">
                            <span class="status-badge status-{{ $task->status }}">{{ \App\Models\Task::STATUSES[$task->status] }}</span>
                            <h3><a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a></h3>
                            @if ($task->description)
                                <p>{{ \Illuminate\Support\Str::limit($task->description, 180) }}</p>
                            @else
                                <p class="muted">No description provided.</p>
                            @endif
                        </div>
                        <div class="task-card-side">
                            <span class="due-label">DUE</span>
                            <strong>{{ $task->due_date?->format('M j, Y') ?? 'No due date' }}</strong>
                            @auth
                                <div class="row-actions">
                                    <a class="button button-secondary button-small" href="{{ route('tasks.edit', $task) }}">Edit</a>
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button button-secondary button-small" type="submit">Archive</button>
                                    </form>
                                    <form method="POST" action="{{ route('tasks.delete', $task) }}" onsubmit="return confirm('Permanently delete this task? This action cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button button-danger button-small" type="submit">Delete</button>
                                    </form>
                                </div>
                            @endauth
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        @if ($tasks->hasPages())
            <div class="pagination-wrap">{{ $tasks->links() }}</div>
        @endif
    </section>
@endsection
