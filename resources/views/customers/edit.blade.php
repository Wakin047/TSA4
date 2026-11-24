@extends('layouts.app')

@section('title', 'Edit customer | BlueCart')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Customer directory</p>
            <h1>Edit customer</h1>
            <p class="page-description">Update {{ $customer->full_name }}'s record.</p>
        </div>
        <a class="button button-secondary" href="{{ route('customers.index') }}">Back to customers</a>
    </div>

    @include('customers._form', [
        'action' => route('customers.update', $customer),
        'method' => 'PUT',
        'buttonLabel' => 'Save changes',
    ])
@endsection
