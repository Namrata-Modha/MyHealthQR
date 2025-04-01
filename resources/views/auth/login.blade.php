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
    @vite(['resources/js/rememberMe.js'])
</head>
<body class="bg-brandGrayDark text-brandGrayLight h-screen flex items-center justify-center relative">

    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
         style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="absolute inset-0 bg-brandGrayDark/70"></div>  <!-- Dark overlay -->
    </div>

    <!-- ✅ Fully Centered Login Container -->
    <div class="w-full max-w-sm p-8 bg-brandGrayDark bg-opacity-95 shadow-lg rounded-lg relative z-10 border border-brandGreen">
        <!-- ✅ Logo & Title -->
        <div class="text-center">
            <img src="{{ asset('images/loginBanner.jpg') }}" alt="MyHealthQR Logo" 
                class="h-16 w-full object-contain bg-brandGrayDark rounded-t-lg">
            <h2 class="text-2xl font-bold text-brandGreen mt-4">Sign in to MyHealthQR</h2>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-brandGrayLight text-base mb-1">Email Address</label>
                <input type="email" id="email" name="email"  autofocus
                    class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="relative">
                <label for="password" class="block text-brandGrayLight text-base mb-1">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none pr-10"
                    placeholder="Password">
                <!-- Eye Icon -->
                <button type="button" id="toggle-password" 
                    class="absolute top-3/4 right-3 transform -translate-y-1/2 flex items-center">
                    <i id="eye-icon" class="fa fa-eye-slash text-brandGrayLight hover:text-white transition duration-200"></i>
                </button>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me + Forgot Password -->
            <div class="flex items-center justify-between text-base">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="text-brandGreen">
                    <span class="ml-2 text-brandGrayLight">Remember me</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-brandBlue hover:underline">
                    Forgot password?
                </a>
            </div>

            <!-- Login Button -->
            <button type="submit"
                class="w-full bg-brandGreen text-white py-3 rounded-lg shadow-md hover:bg-brandGreen-hover transition-transform transform hover:scale-105 duration-300">
                Sign In
            </button>
        </form>

        <!-- Register Link -->
        <p class="text-brandGrayLight text-base text-center mt-6">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-brandBlue hover:underline font-bold">Sign up</a>
        </p>
    </div>
    <!-- ✅ jQuery and Validation Scripts (Optional for future validation) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

</body>
</html>
