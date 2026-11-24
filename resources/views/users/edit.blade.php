@extends('layouts.app')

@section('title', 'Edit user | BlueCart')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Team directory</p>
            <h1>Edit user</h1>
            <p class="page-description">Update {{ $user->full_name }}'s profile.</p>
        </div>
        <a class="button button-secondary" href="{{ route('users.index') }}">Back to users</a>
    </div>

    @include('users._form', [
        'action' => route('users.update', $user),
        'method' => 'PUT',
        'buttonLabel' => 'Save changes',
    ])
@endsection
