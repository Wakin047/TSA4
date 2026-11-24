@extends('layouts.app')

@section('title', 'Customers | BlueCart')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Customer directory</p>
            <h1>Customers</h1>
            <p class="page-description">Create and update your customer records.</p>
        </div>
        <a class="button button-primary" href="{{ route('customers.create') }}">＋ Create customer</a>
    </div>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>Customer list</h2>
                <p>{{ $customers->total() }} {{ \Illuminate\Support\Str::plural('customer', $customers->total()) }}</p>
            </div>
        </div>
        <div class="table-scroll">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="avatar-heading">AVATAR</th>
                        <th>FULLNAME</th>
                        <th>EMAIL</th>
                        <th>PHONE</th>
                        <th class="actions-heading">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>
                            <td class="muted">#{{ $customer->id }}</td>
                            <td class="avatar-cell">
                                @if ($customer->avatar_path)
                                    <img class="avatar" src="{{ asset('storage/'.$customer->avatar_path) }}" alt="{{ $customer->full_name }} avatar">
                                @else
                                    <img
                                        class="avatar avatar-default-photo"
                                        src="{{ asset('images/avatars/default-dog.png') }}?v={{ filemtime(public_path('images/avatars/default-dog.png')) }}"
                                        alt="{{ $customer->full_name }} avatar"
                                    >
                                @endif
                            </td>
                            <td><strong>{{ $customer->full_name }}</strong></td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>
                                <div class="row-actions">
                                    <a class="button button-secondary button-small" href="{{ route('customers.show', $customer) }}">View</a>
                                    <a class="button button-secondary button-small" href="{{ route('customers.edit', $customer) }}">Edit</a>
                                    <form method="POST" action="{{ route('customers.destroy', $customer) }}">
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
                                    <span class="empty-icon" aria-hidden="true">♧</span>
                                    <h3>No customers yet</h3>
                                    <p>Create a customer record to get started.</p>
                                    <a class="button button-primary" href="{{ route('customers.create') }}">Create your first customer</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($customers->hasPages())
            <div class="pagination-wrap">{{ $customers->links() }}</div>
        @endif
    </section>
@endsection
