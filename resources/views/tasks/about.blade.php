@extends('layouts.tasks')

@section('title', 'About | Tasks for Today')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">About the workspace</p>
            <h1>Small steps add up.</h1>
            <p class="page-description">Tasks for Today is a focused place to plan and track everyday work.</p>
        </div>
    </div>

    <section class="panel detail-panel">
        <h2>Simple task management</h2>
        <p class="detail-description">Browse active tasks without signing in. Registered users can create and update tasks, change their status, and archive work that is no longer active. When a task changes to done, the application sends a completion email to the configured recipient.</p>
        <div class="form-actions">
            <a class="button button-primary" href="{{ route('tasks.index') }}">Browse tasks</a>
            @guest
                <a class="button button-secondary" href="{{ route('login') }}">Sign in to manage</a>
            @endguest
        </div>
    </section>
@endsection
