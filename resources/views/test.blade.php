<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - MyHealthQR</title>
    
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Load Tailwind CSS & JavaScript using Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/js/passwordValidation.js'])

</head>
<body class="bg-brandGrayDark text-brandGrayLight min-h-screen flex flex-col items-center justify-between relative">
    <!-- ✅ Background Image -->
    <div class="absolute top-0 left-0 w-full min-h-full bg-cover bg-center bg-no-repeat" 
        style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="absolute inset-0 bg-brandGrayDark/70"></div>  <!-- Dark overlay for readability -->
    </div>

    <!-- ✅ Fully Centered Signup Container -->
    <div class="w-full max-w-md min-h-[825px] p-8 bg-brandGrayDark bg-opacity-95 shadow-lg rounded-lg relative z-10 max-h-[90vh] mt-12 mb-8 border border-brandGreen">   
         <!-- ✅ Logo as a Banner -->
        <img src="{{ asset('images/logo.png') }}" alt="MyHealthQR Logo" 
             class="w-full h-24 object-cover bg-brandGrayLight rounded-t-lg">

        <!-- Signup Form Header -->
        <h2 class="text-2xl font-bold text-brandGreen text-center mt-4">Create Your Account</h2>

        <!-- Signup Form -->
        <form id="signupForm" method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
            @csrf

            <!-- First Name -->
            <div>
                <label for="first_name" class="block text-brandGrayLight text-sm mb-1">First Name</label>
                <input type="text" name="first_name" id="first_name"
                    class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    value="{{ old('first_name') }}" placeholder="First Name">
                @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Last Name -->
            <div>
                <label for="last_name" class="block text-brandGrayLight text-sm mb-1">Last Name</label>
                <input type="text" name="last_name" id="last_name"
                    class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    value="{{ old('last_name') }}" placeholder="Last Name">
                @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-brandGrayLight text-sm mb-1">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    value="{{ old('email') }}" placeholder="Email">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <!-- ✅ Password Field with Eye Icon -->
            <div class="relative">
                <label for="password" class="block text-brandGrayLight text-sm mb-1">Password</label>

                <input type="password" name="password" id="password"
                    class="w-full h-10 px-4 pr-12 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    placeholder="Password">
                
                <!-- ✅ Eye Icon (Fixed Position) -->
                <button type="button" id="toggle-password"
                    class="absolute top-1/2 right-3 transform -translate-y-1/2 flex items-center">
                    <i id="eye-icon" class="fa fa-eye-slash text-brandGrayLight hover:text-white transition duration-200"></i>
                </button>
                <div id="password-strength" class="mt-1 text-sm text-brandGrayLight"></div> <!-- Strength Meter Message -->
            </div>

            <!-- ✅ Confirm Password Field with Matching Eye Icon -->
            <div class="relative">
                <label for="password_confirmation" class="block text-brandGrayLight text-sm mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full h-10 px-4 pr-12 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    placeholder="Confirm Password">                
                <!-- ✅ Matching Eye Icon -->
                <button type="button" id="toggle-confirm-password"
                    class="absolute top-1/2 right-3 transform -translate-y-1/2 flex items-center">
                    <i id="eye-icon-confirm" class="fa fa-eye-slash text-brandGrayLight hover:text-white transition duration-200"></i>
                </button>
                
                <!-- ✅ Password Mismatch Message (Real-Time) -->
                <p id="password-match-message" class="text-sm mt-1 text-red-500 hidden">
                        Passwords do not match.
                </p>

            </div>




            <!-- ✅ Date of Birth -->
            <div>
                <label for="date_of_birth" class="block text-brandGrayLight text-sm mb-1">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth"
                    class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    value="{{ old('date_of_birth') }}">
                @error('date_of_birth') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Sign Up Button -->
            <button type="submit"
                class="w-full bg-brandGreen text-white py-3 rounded-lg shadow-md hover:bg-brandGreen-hover transition-transform transform hover:scale-105 duration-300">
                Sign Up
            </button>
        </form>

        <!-- Already a User? -->
        <p class="text-brandGrayLight text-sm text-center mt-6">
            Already a user? <a href="{{ route('login') }}" class="text-brandBlue hover:text-brandBlue-hover underline">Login</a>
        </p>
    </div>

    <!-- ✅ Footer (Same as Welcome Page) -->
    <footer class="bg-brandGrayDark text-brandGrayLight text-center py-2 w-full mt-auto relative z-10">
        <p>&copy; 2025 MyHealthQR. All Rights Reserved.</p>
    </footer>
</body>
</html>
