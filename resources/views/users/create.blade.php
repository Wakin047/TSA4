@extends('layouts.app')

@section('title', 'Create user | BlueCart')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Team directory</p>
            <h1>Create user</h1>
            <p class="page-description">Add a user profile to your team.</p>
        </div>
        <a class="button button-secondary" href="{{ route('users.index') }}">Back to users</a>
    </div>

    @include('users._form', [
        'action' => route('users.store'),
        'method' => 'POST',
        'buttonLabel' => 'Create user',
    ])
@endsection
