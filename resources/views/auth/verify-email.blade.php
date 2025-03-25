@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Email Verification Required</h2>
    <p>Please check your email and click on the verification link to activate your account.</p>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <x-button type="submit">Resend Verification Email</x-button>

    </form>
</div>
@endsection
