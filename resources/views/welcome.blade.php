<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyHealthQR - Welcome</title>
    
    <!-- Load Tailwind CSS & JavaScript using Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-gray-100">  <!-- Dark background with light text -->

    <!-- Navigation Bar -->
    <header class="bg-gray-900 text-white shadow-md">
        <div class="container mx-auto px-6 py-2 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="MyHealthQR Logo" class="h-12">
                <span class="text-lg font-bold text-brandGreen">MyHealthQR</span>
            </div>
            <nav>
                <a href="{{ route('login') }}" class="text-brandBlue hover:text-blue-500 px-3">Login</a>
                <a href="{{ route('register') }}" class="bg-brandGreen text-white px-5 py-2 rounded-lg hover:bg-green-700">
                    Sign Up
                </a>
            </nav>
        </div>
    </header>

    <!-- Hero Section with Background Image -->
    <section class="relative text-center mb-0 py-20 bg-gray-900 mb-6">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
             style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
            <div class="absolute inset-0 bg-gray-900/70"></div>  <!-- Dark overlay for readability -->
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 pt-6 sm:pt-4 md:pt-2">
            <h1 class="text-3xl py-16 sm:text-4xl md:text-5xl font-extrabold text-white">
                Your Health, One Scan Away
            </h1>
            <p class="mt-2 text-gray-300 max-w-2xl mx-auto">
                MyHealthQR provides secure, real-time access to your medical information via QR code scanning.
            </p>
            <div class="mt-6">
                <a href="{{ route('register') }}"
                    class="bg-brandGreen text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-700 transition-transform transform hover:scale-105 duration-300">
                    Get Started
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container mt-2 mx-auto py-12 px-6 mb-0">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-4 md:px-6">
            <div class="p-6 bg-gray-800 shadow-lg rounded-lg text-center">
                <h3 class="text-xl font-bold text-brandGreen">QR Code Access</h3>
                <p class="text-gray-300 mt-2">Scan & access your medical records anytime, anywhere.</p>
            </div>
            <div class="p-6 bg-gray-800 shadow-lg rounded-lg text-center">
                <h3 class="text-xl font-bold text-brandGreen">Secure & Private</h3>
                <p class="text-gray-300 mt-2">Your data is encrypted and protected by role-based access.</p>
            </div>
            <div class="p-6 bg-gray-800 shadow-lg rounded-lg text-center">
                <h3 class="text-xl font-bold text-brandGreen">Emergency Help</h3>
                <p class="text-gray-300 mt-2">Enable quick access to essential medical details for first responders.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 text-center py-6 mt-8">
        <p>&copy; 2025 MyHealthQR. All Rights Reserved.</p>
    </footer>

</body>
</html>
