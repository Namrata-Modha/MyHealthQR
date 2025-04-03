@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center">
    
    <!--  Centered Container -->
    <div class="w-full max-w-md bg-brandGrayMedium p-8 shadow-lg rounded-lg border border-brandGreen text-center">
        
        <!--  Logo -->
        <img src="{{ asset('images/logo.png') }}" alt="MyHealthQR Logo" 
             class="w-full h-16 object-cover bg-brandGrayLight rounded-t-lg">

        <!--  Header -->
        <h2 class="text-2xl font-bold text-brandGreen mt-4">Verify Your Email Address</h2>

        <!--  Success Message for Resent Email -->
        @if (session('resent'))
            <div class="bg-green-500 text-white text-sm px-4 py-2 rounded-md mt-4 shadow-md">
                 A new verification link has been sent to your email.
            </div>
        @endif

        <!--  Instructions -->
        <p class="mt-4 text-sm text-brandGrayLight">
            Please check your email for a verification link before proceeding.
        </p>
        <p class="text-sm text-brandGrayLight mt-2">
            If you did not receive the email, click below to request another.
        </p>

        <!--  Resend Verification Form -->
        <form method="POST" action="{{ route('verification.resend') }}" class="mt-6 flex flex-col items-center">
            @csrf
            <button type="submit"
                class="w-full bg-brandGreen text-white py-3 rounded-lg shadow-md hover:bg-brandGreen-hover transition-transform transform hover:scale-105 duration-300">
                Resend Verification Email
            </button>
        </form>
    </div>
</div>
@endsection
