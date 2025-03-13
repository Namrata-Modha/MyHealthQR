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
    @vite(['resources/js/passwordStrength.js'])


</head>
<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col items-center justify-between relative">
    <!-- ✅ Background Image -->
    <div class="absolute top-0 left-0 w-full min-h-full bg-cover bg-center bg-no-repeat" 
        style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="absolute inset-0 bg-gray-900/70"></div>  <!-- Dark overlay for readability -->
    </div>

    <!-- ✅ Fully Centered Signup Container -->
    <div class="w-full max-w-md min-h-[825px] p-8 bg-gray-800 bg-opacity-90 shadow-lg rounded-lg relative z-10 max-h-[90vh] mt-12 mb-8 border border-brandGreen">   
         <!-- ✅ Logo as a Banner -->
        <img src="{{ asset('images/logo.png') }}" alt="MyHealthQR Logo" 
             class="w-full h-24 object-cover bg-gray-700 rounded-t-lg">

        <!-- ✅ Signup Form Header -->
        <h2 class="text-2xl font-bold text-brandGreen text-center mt-4">Create Your Account</h2>

        <!-- ✅ Signup Form -->
        <form id="signupForm" method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
            @csrf

            <!-- ✅ First Name -->
            <div>
                <label for="first_name" class="block text-gray-300 text-sm mb-1">First Name</label>
                <input type="text" name="first_name" id="first_name"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    value="{{ old('first_name') }}" placeholder="First Name">
                @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- ✅ Last Name -->
            <div>
                <label for="last_name" class="block text-gray-300 text-sm mb-1">Last Name</label>
                <input type="text" name="last_name" id="last_name"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    value="{{ old('last_name') }}" placeholder="Last Name">
                @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- ✅ Email -->
            <div>
                <label for="email" class="block text-gray-300 text-sm mb-1">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    value="{{ old('email') }}" placeholder="Email">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <!-- ✅ Password -->
            <div class="relative">
                <label for="password" class="block text-gray-300 text-sm mb-1">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:ring-2 focus:ring-brandGreen focus:outline-none pr-10"
                    placeholder="Password">
                
                <!-- ✅ Eye Icon (Fixed Vertical Centering) -->
                <button type="button" id="toggle-password" 
                    class="absolute top-1/2 -translate-y-1/2 right-3 transform flex items-center h-full">
                    <i id="eye-icon" class="fa fa-eye text-gray-400 hover:text-white transition duration-200"></i>
                </button>

                <div id="password-strength" class="mt-1 text-sm text-gray-400"></div> <!-- Strength Meter Message -->
            </div>


            <!-- ✅ Date of Birth -->
            <div>
                <label for="date_of_birth" class="block text-gray-300 text-sm mb-1">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    value="{{ old('date_of_birth') }}">
                @error('date_of_birth') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- ✅ Guardian Consent Checkbox (Hidden by Default) -->
            <div id="guardianConsentField" class="hidden">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="guardian_consent" id="guardian_consent" class="text-brandGreen">
                    <span class="text-gray-300 text-sm">I am the guardian of this user.</span>
                </label>
                @error('guardian_consent') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- ✅ Terms & PIPEDA Consent -->
            <div>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="security_agreement_signed" class="text-brandGreen">
                    <span class="text-gray-300 text-sm">
                        I agree to the <a href="{{ route('terms') }}" class="text-brandBlue hover:underline">Terms of Service</a> 
                        and <a href="{{ route('privacy') }}" class="text-brandBlue hover:underline">Privacy Policy</a>.
                    </span>
                </label>
            </div>

            <div>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="pipeda_consent" class="text-brandGreen">
                    <span class="text-gray-300 text-sm">
                        I consent to the collection and use of my personal data in compliance with 
                        <a href="https://www.priv.gc.ca/en/privacy-topics/privacy-laws-in-canada/the-personal-information-protection-and-electronic-documents-act-pipeda/pipeda_brief/" 
                        class="text-brandBlue hover:underline">PIPEDA (Canadian law)</a>.
                    </span>
                </label>
            </div>

            <!-- ✅ Sign Up Button -->
            <button type="submit"
                class="w-full bg-brandGreen text-white py-3 rounded-lg shadow-md hover:bg-green-700 transition-transform transform hover:scale-105 duration-300">
                Sign Up
            </button>
        </form>

        <!-- ✅ Already a User? -->
        <p class="text-gray-400 text-sm text-center mt-6">
            Already a user? <a href="{{ route('login') }}" class="text-brandBlue hover:underline">Login</a>
        </p>
    </div>

    <!-- ✅ Footer (Same as Welcome Page) -->
    <footer class="bg-gray-900 text-gray-400 text-center py-2 w-full mt-auto relative z-10">
        <p>&copy; 2025 MyHealthQR. All Rights Reserved.</p>
    </footer>
</body>
</html>
