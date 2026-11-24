@extends('layouts.tasks')

@section('title', 'Archived tasks | Tasks for Today')

@section('content')
    <section class="page-heading">
        <div>
            <p class="eyebrow">Task history</p>
            <h1>Archived tasks</h1>
            <p class="page-description">Tasks you have archived are kept here and hidden from your active list.</p>
        </div>
        <a class="button button-secondary" href="{{ route('tasks.index') }}">Back to active tasks</a>
    </section>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>Archived tasks</h2>
                <p>{{ $tasks->total() }} {{ \Illuminate\Support\Str::plural('task', $tasks->total()) }}</p>
            </div>
        </div>

        @if ($tasks->isEmpty())
            <div class="empty-state">
                <span class="empty-icon" aria-hidden="true">✓</span>
                <h3>No archived tasks</h3>
                <p>Tasks you archive will appear here.</p>
                <a class="button button-primary" href="{{ route('tasks.index') }}">Back to active tasks</a>
            </div>
        @else
            <div class="task-list">
                @foreach ($tasks as $task)
                    <article class="task-card">
                        <div class="task-card-main">
                            <span class="archived-badge">Archived</span>
                            <span class="status-badge status-{{ $task->status }}">{{ \App\Models\Task::STATUSES[$task->status] }}</span>
                            <h3>{{ $task->title }}</h3>
                            @if ($task->description)
                                <p>{{ \Illuminate\Support\Str::limit($task->description, 180) }}</p>
                            @else
                                <p class="muted">No description provided.</p>
                            @endif
                        </div>
                        <div class="task-card-side">
                            <span class="due-label">DUE</span>
                            <strong>{{ $task->due_date?->format('M j, Y') ?? 'No due date' }}</strong>
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
