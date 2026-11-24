@extends('layouts.tasks')

@section('title', 'Edit task | Tasks for Today')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Task list</p>
            <h1>Edit task</h1>
            <p class="page-description">Update “{{ $task->title }}”.</p>
        </div>
        <a class="button button-secondary" href="{{ route('tasks.show', $task) }}">Back to task</a>
    </div>

    @include('tasks._form', [
        'action' => route('tasks.update', $task),
        'method' => 'PUT',
        'buttonLabel' => 'Save changes',
    ])
@endsection
