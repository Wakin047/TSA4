@extends('layouts.app')

@section('title', 'Create customer | BlueCart')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Customer directory</p>
            <h1>Create customer</h1>
            <p class="page-description">Add a customer to your records.</p>
        </div>
        <a class="button button-secondary" href="{{ route('customers.index') }}">Back to customers</a>
    </div>

    @include('customers._form', [
        'action' => route('customers.store'),
        'method' => 'POST',
        'buttonLabel' => 'Create customer',
    ])
@endsection
