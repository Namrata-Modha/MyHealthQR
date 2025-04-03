<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - MyHealthQR</title>

    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Tailwind & App CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brandGrayDark text-brandGrayLight min-h-screen flex items-center justify-center relative">

    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="absolute inset-0 bg-brandGrayDark/70"></div>
    </div>

    <!--  Forgot Password Container -->
    <div class="w-full max-w-md p-6 bg-brandGrayDark bg-opacity-95 shadow-lg rounded-lg border border-brandGreen relative z-10">
        <!--  Logo & Title -->
        <div class="text-center">
            <img src="{{ asset('images/loginBanner.jpg') }}" alt="MyHealthQR Logo" 
                class="h-16 w-full object-contain bg-brandDarkGray rounded-t-lg">
            <h2 class="text-xl font-bold text-brandGreen mt-4">Reset Your Password</h2>
        </div>

        <!--  Flash Message -->
        @if (session('status'))
            <div class="mt-4 p-3 text-sm text-green-500 bg-green-100 border border-green-300 rounded">
                {{ session('status') }}
            </div>
        @endif

        <!--  Password Reset Form -->
        <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-4">
            @csrf

            <!--  Email Input -->
            <div>
                <label for="email" class="block text-base text-brandGrayLight mb-1">Email Address</label>
                <input id="email" type="email"
                    class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!--  Submit Button -->
            <button type="submit"
                class="w-full bg-brandGreen text-white py-3 rounded-lg shadow-md hover:bg-brandGreen-hover transition-transform transform hover:scale-105 duration-300">
                Send Password Reset Link
            </button>

            <!--  Back to Login -->
            <div class="text-center mt-4">
                <a href="{{ route('login') }}"
                   class="inline-block text-base text-brandBlue hover:text-brandBlue-hover underline transition">
                    ← Back to Login
                </a>
            </div>
        </form>
    </div>

</body>
</html>
