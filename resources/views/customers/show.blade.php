@extends('layouts.app')

@section('title', $customer->full_name.' | BlueCart')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Customer directory</p>
            <h1>{{ $customer->full_name }}</h1>
            <p class="page-description">Customer record #{{ $customer->id }}</p>
        </div>
        <a class="button button-secondary" href="{{ route('customers.index') }}">Back to customers</a>
    </div>

    <section class="panel form-panel">
        <dl class="form-grid">
            <div class="form-field">
                <dt>Email</dt>
                <dd>{{ $customer->email }}</dd>
            </div>
            <div class="form-field">
                <dt>Phone</dt>
                <dd>{{ $customer->phone }}</dd>
            </div>
        </dl>
        <div class="form-actions">
            <a class="button button-primary" href="{{ route('customers.edit', $customer) }}">Edit customer</a>
        </div>
    </section>
@endsection
