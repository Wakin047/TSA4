@extends('layouts.tasks')

@section('title', 'Profile | Tasks for Today')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Profile</p>
            <h1>Make today count.</h1>
            <p class="page-description">Tasks for Today keeps everyday work organized and easy to follow.</p>
        </div>
    </div>

    <section class="panel detail-panel">
        <h2>About this workspace</h2>
        <p class="detail-description">This task management system helps you create, update, and track work in one shared list. Sign in to manage tasks and update your account profile.</p>
        <div class="form-actions">
            <a class="button button-primary" href="{{ route('tasks.index') }}">View task list</a>
            @auth
                <a class="button button-secondary" href="{{ route('profile.edit') }}">Edit account profile</a>
            @else
                <a class="button button-secondary" href="{{ route('login') }}">Sign in</a>
            @endauth
        </div>
    </section>
@endsection
