@extends('layouts.app')

@section('hide_navbar', 'yes')

@section('content')


<div class="text-center container mt-6">
    <h1 class="text-2xl font-bold text-brandGreen mb-4">Email Verification Required</h1>
    <p class="text-xl font-bold mb-2">Please check your email and click on the verification link to activate your account.</p>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <x-button type="submit">Resend Verification Email</x-button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('login') }}"
           class="inline-block font-bold text-base text-brandBlue hover:text-brandBlue-hover underline transition">
            ← Back to Login
        </a>
    </div>

</div>
@endsection
