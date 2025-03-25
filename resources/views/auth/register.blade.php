<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - MyHealthQR</title>
    
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Load Tailwind CSS & JavaScript using Vite -->
    @section('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/register.js'])
    @vite(['resources/js/passwordValidation.js'])

</head>
<body class="bg-brandGrayDark text-brandGrayLight min-h-screen flex flex-col items-center justify-between relative">

    <!-- ✅ Background Image -->>
    <div class="absolute top-0 left-0 w-full min-h-full bg-cover bg-center bg-no-repeat" 
        style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="absolute inset-0 bg-brandGrayDark/70"></div>  <!-- Dark overlay for readability -->
    </div>

    <!-- ✅ Fully Centered Signup Container -->
    <div class="w-full max-w-md p-6 bg-brandGrayDark bg-opacity-95 shadow-lg rounded-lg relative z-10 mt-6 mb-6 border border-brandGreen">   
         <!-- ✅ Logo as a Banner -->
        <img src="{{ asset('images/logo.png') }}" alt="MyHealthQR Logo" 
             class="w-full h-20 object-contain bg-brandDarkGray rounded-t-lg">

        <!-- Signup Form Header -->
        <h2 class="text-2xl font-bold text-brandGreen text-center mt-2">Create Your Account</h2>

        <!-- Signup Form -->
        <form id="signupForm" method="POST" action="{{ route('register') }}" class="mt-4 space-y-2" novalidate>
             @csrf

            <!-- First Name -->
            <div>
                <label for="first_name" class="block text-brandGrayLight text-base mb-1">First Name</label>
                <input type="text" name="first_name" id="first_name"
                    class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    value="{{ old('first_name') }}" placeholder="First Name">
                @error('first_name') <span class="text-red-500 text-s">{{ $message }}</span> @enderror
            </div>

            <!-- Last Name -->
            <div>
                <label for="last_name" class="block text-brandGrayLight text-base mb-1">Last Name</label>
                <input type="text" name="last_name" id="last_name"
                    class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    value="{{ old('last_name') }}" placeholder="Last Name">
                @error('last_name') <span class="text-red-500 text-s">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-brandGrayLight text-base mb-1">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    value="{{ old('email') }}" placeholder="Email">
                @error('email') <span class="text-red-500 text-s">{{ $message }}</span> @enderror
            </div>
            
            <!-- ✅ Password Field with Eye Icon -->
            <div class="relative">
                <label for="password" class="block text-brandGrayLight text-base mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password"
                        class="w-full h-10 px-4 pr-12 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                        placeholder="Password">    
                    <!-- ✅ Eye Icon -->
                    <button type="button" id="toggle-password"
                        class="absolute inset-y-0 right-3 flex items-center">
                        <i id="eye-icon" class="fa fa-eye-slash text-brandGrayLight hover:text-white transition duration-200"></i>
                    </button>
                </div>
                <div id="password-strength" class="mt-1 text-base text-brandGrayLight"></div> <!-- Strength Meter Message -->
                @error('password') <span class="text-red-500 text-s">{{ $message }}</span> @enderror
            </div>
 
            <!-- ✅ Confirm Password Field -->
            <div class="relative">
                <label for="password_confirmation" class="block text-brandGrayLight text-base mb-1">Confirm Password</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full h-10 px-4 pr-12 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                        placeholder="Confirm Password">
                    @error('password_confirmation') <span class="text-red-500 text-s">{{ $message }}</span> @enderror                
                    <!-- ✅ Matching Eye Icon -->
                    <button type="button" id="toggle-confirm-password"
                        class="absolute inset-y-0 right-3 flex items-center">
                        <i id="eye-icon-confirm" class="fa fa-eye-slash text-brandGrayLight hover:text-white transition duration-200"></i>
                    </button>
                </div>
                <!-- ✅ Password Mismatch Message (Real-Time) -->
                <p id="password-match-message" class="text-base mt-1 text-red-500 hidden">
                        Passwords do not match.
                </p>
            </div>

            <!-- ✅ Date of Birth -->
            <div>
                <label for="date_of_birth" class="block text-brandGrayLight text-base mb-1">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" max="{{ date('Y-m-d') }}"
                     class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    value="{{ old('date_of_birth') }}">
                @error('date_of_birth') <span class="text-red-500 text-s">{{ $message }}</span> @enderror
            </div>

            <!-- ✅ Guardian Consent Checkbox (Only Shows If Under 18) -->
            <div id="guardianConsentField" class="{{ old('date_of_birth') && (!$errors->has('guardian_consent') ? 'hidden' : '') }}">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="guardian_consent" id="guardian_consent" class="text-brandGreen"
                        {{ old('guardian_consent') ? 'checked' : '' }}>
                    <span class="text-brandGrayLight text-base">I am the guardian of this user.</span>
                </label>
                @error('guardian_consent') 
                    <span class="text-red-500 text-s block">{{ $message }}</span> 
                @enderror
            </div>


            <!-- ✅ Consent Checkboxes -->
            <div class="mt-4">
                <label for="security_agreement_signed" class="inline-flex items-center space-x-2">
                <input type="checkbox" name="security_agreement_signed" id="security_agreement_signed" class="text-brandGreen"
                value="1" {{ old('security_agreement_signed') ? 'checked' : '' }}>
                    <span class="text-brandGrayLight text-base">
                        I agree to the <a href="{{ route('terms') }}" class="text-brandBlue hover:underline" style="font-weight: bold;">Terms of Service</a> 
                        and <a href="{{ route('privacy') }}" class="text-brandBlue hover:underline" style="font-weight: bold;">Privacy Policy</a>.
                    </span>
                </label>
                <div 
                id="security-agreement-error" 
                class="text-red-500 text-xs hidden">
                </div>
            </div>

            <div class="flex flex-col">
            <!-- ✅ Checkbox and Label -->
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="pipeda_consent" id="pipeda_consent" class="text-brandGreen" value="1"
                    {{ old('pipeda_consent') ? 'checked' : '' }}>
                <span class="text-brandGrayLight text-base">
                    I consent to the collection and use of my personal data in compliance with 
                    <a href="https://www.priv.gc.ca/en/privacy-topics/privacy-laws-in-canada/the-personal-information-protection-and-electronic-documents-act-pipeda/pipeda_brief/" 
                    class="text-brandBlue hover:underline font-bold">PIPEDA (Canadian law)</a>.
                </span>
            </label>

            <!-- ✅ Error message appears below text, not beside -->
            @error('pipeda_consent') 
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>  
            @enderror
        </div>




            <!-- ✅ Sign Up Button -->
            <button type="submit" id="signup-btn"
                class="w-full bg-brandGreen text-white py-3 rounded-lg shadow-md hover:bg-brandGreen-hover transition-transform transform hover:scale-105 duration-300">
                Sign Up
            </button>
        </form>
        <div class="mt-3 text-center">
            Already a user? <a href="{{ route('login.form') }}" class="btn btn-primary" style="font-weight: bold; text-decoration: underline;">Login</a>
        </div>
    </div>
    <!-- ✅ Footer (Same as Welcome Page) -->
    <footer class="bg-brandGrayDark text-brandGrayLight text-center py-2 w-full mt-auto relative z-10">
        <p>&copy; {{ date('Y') }} MyHealthQR. All Rights Reserved.</p>
    </footer>

    <script>
document.addEventListener("DOMContentLoaded", function () {
    const signupForm = document.getElementById("signupForm");

    if (signupForm) {
        signupForm.addEventListener("submit", function (e) {
            console.log("🚀 Form Submission Attempted!");

            if (typeof $ !== "undefined" && $("#signupForm").length > 0 && !$("#signupForm").valid()) {
                console.log("❌ Form Validation Failed - Check Error Messages");
                e.preventDefault(); // ✅ Stop submission if validation fails
                return;
            }

            console.log("✅ Form Passed Validation - Submitting!");
        });
    }
});
</script>


</body>
</html>
