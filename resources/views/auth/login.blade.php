<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyHealthQR</title>
    
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <!-- Load Tailwind CSS & JavaScript using Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/js/passwordValidation.js'])


</head>
<body class="bg-gray-900 text-gray-100 h-screen flex items-center justify-center relative">  <!-- Full-page center -->
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
         style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="absolute inset-0 bg-gray-900/70"></div>  <!-- Dark overlay for readability -->
    </div>
    <!-- ✅ Fully Centered Login Container -->
    <div class="w-full max-w-sm p-8 bg-gray-800 bg-opacity-90 shadow-lg rounded-lg relative z-10  border border-brandGreen">
        <!-- ✅ Logo & Title -->
        <div class="text-center">
            <img src="{{ asset('images/loginBanner.jpg') }}" alt="MyHealthQR Logo" 
             class="h-16 w-full object-cover bg-gray-700 rounded-t-lg">
            <h2 class="text-2xl font-bold text-brandGreen mt-4">Sign in to MyHealthQR</h2>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-500 text-white text-sm px-4 py-2 rounded-md mt-4 text-center shadow-md">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-500 text-white text-sm px-4 py-2 rounded-md mt-4 text-center shadow-md">
                {{ session('error') }}
            </div>
        @endif

        <!-- Centered Login Form -->
        <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
            @csrf
            
            <!-- Email Field -->
            <div>
                <label for="email" class="block text-gray-300 text-sm mb-1">Email Address</label>
                <input type="email" id="email" name="email" required autofocus
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-900 focus:ring-2 focus:ring-brandGreen focus:outline-none">
            </div>

            <!-- ✅ Password Field -->
            <div class="relative">
                <label for="password" class="block text-gray-300 text-sm mb-1">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:ring-2 focus:ring-brandGreen focus:outline-none pr-10"
                    placeholder="Password">
                
                <!-- ✅ Eye Icon (Using FontAwesome) -->
                <button type="button" id="toggle-password" 
                    class="absolute top-3/4 right-3 transform -translate-y-1/2 flex items-center">
                    <i id="eye-icon" class="fa fa-eye-slash text-gray-400 hover:text-white transition duration-200"></i>
                </button>
            </div>





            <!-- ✅ Remember Me & Forgot Password -->
            <div class="flex items-center justify-between text-sm">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="text-brandGreen">
                    <span class="ml-2 text-gray-300">Remember me</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-brandBlue hover:underline">
                    Forgot password?
                </a>
            </div>

            <!-- Centered Login Button -->
            <button type="submit"
                class="w-full bg-brandGreen text-white py-3 rounded-lg shadow-md hover:bg-green-700 transition-transform transform hover:scale-105 duration-300">
                Sign In
            </button>
        </form>

        <!-- Register Link -->
        <p class="text-gray-400 text-sm text-center mt-6">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-brandBlue hover:underline">Sign up</a>
        </p>
    </div>
    @vite(['resources/js/rememberMe.js'])
</body>
</html>
