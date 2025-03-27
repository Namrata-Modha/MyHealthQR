@extends('layouts.app') 

@section('content')
    <!-- ✅ Hero Section -->
    <section class="relative text-center mb-0 py-32 bg-brandGrayDark">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
            style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
            <div class="absolute inset-0 bg-gradient-to-b from-black/90 to-brandGrayDark/95"></div>  <!-- Dark overlay for readability -->
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 pt-6 sm:pt-4 md:pt-2">
            <h1 class="text-3xl py-16 sm:text-4xl md:text-5xl font-extrabold text-white">
                Your Health, One Scan Away
            </h1>
            <p class="mt-2 text-brandGrayLight text-lg sm:text-xl max-w-2xl mx-auto">
                MyHealthQR provides secure, real-time access to your medical information via QR code scanning.
            </p>
            @guest
                <!-- Show this to guests -->
                <div class="mt-6">
                    <a href="{{ route('register') }}"
                        class="bg-brandGreen font-semibold text-white text-base px-6 py-3 rounded-lg shadow-md hover:bg-brandGreen-hover transition-transform transform hover:scale-105 duration-300">
                        Get Started
                    </a> 
                </div>
            @else
                <!-- Show this to authenticated users -->
                <div class="mt-6">
                    <a href="{{ route('dashboard') }}"
                        class="bg-brandBlue text-white font-semibold text-base px-6 py-3 rounded-lg shadow-md hover:bg-brandBlue-hover transition-transform transform hover:scale-105 duration-300">
                        Go to Dashboard
                    </a> 
                </div>
            @endguest

        </div>
    </section>

    <!-- ✅ Features Section -->
    <section class="container mt-2 mx-auto py-6 px-6 mb-0">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-4 md:px-6">
            <div class="p-6 bg-brandGrayMedium border border-brandBorder shadow-lg rounded-lg text-center">
                <h3 class="text-xl font-bold text-brandGreen">QR Code Access</h3>
                <p class="text-brandGrayLight text-base sm:text-lg mt-2">Scan & access your medical records anytime, anywhere.</p>
            </div>
            <div class="p-6 bg-brandGrayMedium border border-brandBorder shadow-lg rounded-lg text-center">
                <h3 class="text-xl font-bold text-brandGreen">Secure & Private</h3>
                <p class="text-brandGrayLight text-base sm:text-lg mt-2">Your data is encrypted and protected by role-based access.</p>
            </div>
            <div class="p-6 bg-brandGrayMedium border border-brandBorder shadow-lg rounded-lg text-center">
                <h3 class="text-xl font-bold text-brandGreen">Emergency Help</h3>
                <p class="text-brandGrayLight text-base sm:text-lg mt-2">Enable quick access to essential medical details for first responders.</p>
            </div>
        </div>
    </section>
@endsection
