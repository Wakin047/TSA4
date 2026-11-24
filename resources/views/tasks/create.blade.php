@extends('layouts.tasks')

@section('title', 'Create task | Tasks for Today')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Task list</p>
            <h1>Create a task</h1>
            <p class="page-description">Add a clear next step to your list.</p>
        </div>
        <a class="button button-secondary" href="{{ route('tasks.index') }}">Back to tasks</a>
    </div>

    @include('tasks._form', [
        'action' => route('tasks.store'),
        'method' => 'POST',
        'buttonLabel' => 'Create task',
    ])
@endsection
