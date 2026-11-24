@extends('layouts.app')

@section('title', $user->full_name.' | BlueCart')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Team directory</p>
            <h1>{{ $user->full_name }}</h1>
            <p class="page-description">User profile #{{ $user->id }}</p>
        </div>
        <a class="button button-secondary" href="{{ route('users.index') }}">Back to users</a>
    </div>

    <section class="panel form-panel">
        <dl class="form-grid">
            <div class="form-field">
                <dt>Username</dt>
                <dd>{{ $user->username }}</dd>
            </div>
            <div class="form-field">
                <dt>Email</dt>
                <dd>{{ $user->email ?? 'Not set' }}</dd>
            </div>
        </dl>
        <div class="form-actions">
            <a class="button button-primary" href="{{ route('users.edit', $user) }}">Edit user</a>
        </div>
    </section>
@endsection
