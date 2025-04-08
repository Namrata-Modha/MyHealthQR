@extends('layouts.app')

@section('hide_navbar', 'yes')

@section('content')
<!-- Background Image -->
<div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
     style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
    <div class="absolute inset-0 bg-brandGrayDark/70"></div>
</div>

<!-- Verify Container -->
<div class="w-full max-w-sm mx-auto p-6 mt-24 bg-brandGrayDark bg-opacity-95 shadow-lg rounded-lg relative z-10 border border-brandGreen">
    <!-- Logo & Title -->
    <div class="text-center">
        <img src="{{ asset('images/loginBanner.jpg') }}" alt="MyHealthQR Logo"
             class="h-16 w-full object-contain bg-brandDarkGray rounded-t-lg">
        <h2 class="text-2xl font-bold text-brandGreen mt-4">Email Verification Required</h2>
        <p class="text-base text-brandGrayLight mt-2">
            Please check your email and click on the verification link to activate your account.
        </p>
    </div>

    <!-- Session Message -->
    @if (session('message'))
        <div class="bg-green-500 text-white text-base px-4 py-2 rounded-md mt-4 text-center shadow-md">
            {{ session('message') }}
        </div>
    @endif

    <!-- Resend Verification -->
    <form method="POST" action="{{ route('verification.resend') }}" class="mt-6 space-y-4">
        @csrf
        <button type="submit"
            class="w-full bg-brandGreen text-white py-3 rounded-lg shadow-md hover:bg-brandGreen-hover transition-transform transform hover:scale-105 duration-300">
            Resend Verification Email
        </button>
    </form>

    <!-- Back to Login -->
    <div class="text-center mt-4">
        <a href="{{ route('login') }}"
           class="inline-block text-base text-brandBlue hover:text-brandBlue-hover underline transition">
            ← Back to Login
        </a>
    </div>
</div>
@endsection
