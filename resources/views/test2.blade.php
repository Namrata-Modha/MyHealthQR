@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-brandGrayDark text-brandGrayLight">
    
    <!-- ✅ Background Image -->
    <div class="absolute top-0 left-0 w-full min-h-full bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="absolute inset-0 bg-brandGrayDark/70"></div>  <!-- Dark overlay -->
    </div>

    <!-- ✅ Centered Verification Container -->
    <div class="w-full max-w-md bg-brandGrayMedium p-8 shadow-lg rounded-lg relative z-10 border border-brandGreen">
        
        <!-- ✅ Logo -->
        <img src="{{ asset('images/logo.png') }}" alt="MyHealthQR Logo" 
             class="w-full h-16 object-cover bg-brandGrayLight rounded-t-lg">

        <!-- ✅ Header -->
        <h2 class="text-2xl font-bold text-brandGreen text-center mt-4">Verify Your Email Address</h2>

        <!-- ✅ Success Message for Resent Email -->
        @if (session('resent'))
            <div class="bg-green-500 text-white text-sm px-4 py-2 rounded-md mt-4 text-center shadow-md">
                ✅ A new verification link has been sent to your email.
            </div>
        @endif

        <!-- ✅ Instructions -->
        <p class="mt-4 text-center text-sm text-brandGrayLight">
            Before proceeding, please check your email for a verification link.
        </p>
        <p class="text-center text-sm text-brandGrayLight mt-2">
            If you did not receive the email, you can request another.
        </p>

        <!-- ✅ Resend Verification Form -->
        <form method="POST" action="{{ route('verification.resend') }}" class="mt-6 flex flex-col items-center">
            @csrf
            <button type="submit"
                class="w-full bg-brandGreen text-white py-3 rounded-lg shadow-md hover:bg-brandGreen-hover transition-transform transform hover:scale-105 duration-300">
                Resend Verification Email
            </button>
        </form>
    </div>

    <!-- ✅ Footer (Same as Welcome Page) -->
    <footer class="bg-brandGrayDark text-brandGrayLight text-center py-2 w-full mt-auto relative z-10">
        <p>&copy; 2025 MyHealthQR. All Rights Reserved.</p>
    </footer>
</div>
@endsection
