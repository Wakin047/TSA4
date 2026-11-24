@extends('layouts.app')

@section('title', 'Users | BlueCart')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Team directory</p>
            <h1>Users</h1>
            <p class="page-description">Create user profiles and manage your team.</p>
        </div>
        <a class="button button-primary" href="{{ route('users.create') }}">＋ Create user</a>
    </div>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>User list</h2>
                <p>{{ $users->total() }} {{ \Illuminate\Support\Str::plural('user', $users->total()) }}</p>
            </div>
        </div>
        <div class="table-scroll">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th class="avatar-heading">Avatar</th>
                        <th>Full name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th class="actions-heading">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="muted">#{{ $users->firstItem() + $loop->index }}</td>
                            <td class="avatar-cell">
                                @if ($user->avatar_path)
                                    <img class="avatar" src="{{ asset('storage/'.$user->avatar_path) }}" alt="{{ $user->full_name }} avatar">
                                @else
                                    <img
                                        class="avatar avatar-default-photo"
                                        src="{{ asset('images/avatars/default-dog.png') }}?v={{ filemtime(public_path('images/avatars/default-dog.png')) }}"
                                        alt="{{ $user->full_name }} avatar"
                                    >
                                @endif
                            </td>
                            <td><strong>{{ $user->full_name }}</strong></td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email ?? '—' }}</td>
                            <td>
                                <div class="row-actions">
                                    <a class="button button-secondary button-small" href="{{ route('users.show', $user) }}">View</a>
                                    <a class="button button-secondary button-small" href="{{ route('users.edit', $user) }}">Edit</a>
                                    <form method="POST" action="{{ route('users.destroy', $user) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button button-secondary button-small" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <span class="empty-icon" aria-hidden="true">♙</span>
                                    <h3>No users yet</h3>
                                    <p>Create a user profile to get started.</p>
                                    <a class="button button-primary" href="{{ route('users.create') }}">Create your first user</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($users->hasPages())
            <div class="pagination-wrap">{{ $users->links() }}</div>
        @endif
    </section>
@endsection
