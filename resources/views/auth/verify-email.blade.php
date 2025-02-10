@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Verify Your Email</h2>
    <p>Please check your email and click the verification link to activate your account.</p>
    
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif

    <form action="{{ route('verification.resend') }}" method="POST">
        @csrf
        <button type="submit">Resend Verification Email</button>
    </form>
</div>
@endsection
