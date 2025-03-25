@extends('layouts.app')
@section('content')

    <div class="flex items-start justify-center min-h-[70vh] pt-2 sm:pt-4 md:pt-6 px-4">

        <div class="w-full max-w-sm p-6 bg-brandGrayDark bg-opacity-95 shadow-lg rounded-lg border border-brandGreen relative z-10">
            <!-- ✅ Logo & Title -->
            <div class="text-center">
                <img src="{{ asset('images/loginBanner.jpg') }}" alt="MyHealthQR Logo" 
                class="h-16 w-full object-contain brandDarkGray rounded-t-lg">
                <h2 class="text-xl font-bold text-brandGreen mt-4">Reset Your Password</h2>
            </div>  
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <!-- Form Selector -->
            <form id="resetPasswordForm" method="POST" action="{{ route('password.update') }}" onsubmit="console.log('🔁 Form submit triggered!')">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <!-- Email (Read-only) -->
                <!-- <div class="mb-3">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" readonly>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div> -->
              
                <x-input 
                    id="email" 
                    name="email" 
                    type="email" 
                    label="Email Address"
                    :value="$email ?? old('email')" 
                    :readonly="true"
                />

            <!-- <div>
                <label for="email" class="block text-base text-brandGrayLight mb-1">Email Address</label>
                <input id="email" type="email"
                    class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div> -->

                <!-- New Password -->
                <x-input 
                    id="password"
                    name="password" 
                    type="password" 
                    label="New Password"
                    required 
                    showEyeIcon="true" 
                />

                <!-- Confirm Password -->
                <x-input 
                    id="password_confirmation"
                    name="password_confirmation" 
                    type="password" 
                    label="Confirm Password"
                    required 
                    showEyeIcon="true" 
                />

                <!-- Button Reset Password -->
                <x-button type="submit">Reset Password</x-button>
                <!-- <button type="submit" class="btn btn-primary">Reset Password</button> -->

            </form>
            <div class="text-center mt-4">
                <a href="{{ route('login') }}"
                    class="inline-block text-base text-brandBlue hover:text-brandBlue-hover underline transition">
                    ← Back to Login
                </a>
        </div>

        @if ($errors->any())
            <div class="text-red-500 bg-red-100 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif
   
    </div>
@endsection

@section('scripts')

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
    console.log("reset jQuery version:", typeof $ !== 'undefined' ? $.fn.jquery : 'NOT LOADED');
    console.log("jQuery Validate present:", typeof $.validator !== 'undefined');
</script> -->

<script>

$(document).ready(function() {

    $('#resetPasswordForm').off('submit').on('submit', function(e) {
        e.preventDefault();
        console.log("🛑 Bypassing validation. Submitting manually.");
        this.submit();
    });

    // ERROR TESTING
    console.log("✅ Document Ready");
    if (!$.validator) {
        console.error("❌ Validator is missing");
        return;
    }

    console.log("reset jQuery version:", typeof $ !== 'undefined' ? $.fn.jquery : 'NOT LOADED');
    console.log("jQuery Validate present:", typeof $.validator !== 'undefined');

    // Add custom regex validation
    $.validator.addMethod("regex", function(value, element, pattern) {
            return this.optional(element) || new RegExp(pattern).test(value);
        });
        
    $("#resetPasswordForm").validate({
        rules: {
            password: {
                required: true,
                minlength: 8,
                regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
            },
            password_confirmation: {
                required: true,
                equalTo: '[name="password"]'
            }
        },
        messages: {
            password: {
                regex: "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character (!@#$%^&*)."
            },
            password_confirmation: {
                equalTo: "Passwords do not match."
            }
        },
        invalidHandler: function (event, validator) {
            console.log("❌ Validation failed");
            console.log("Errors:", validator.errorList);
        },

        // ✅ ADD THIS FUNCTION HERE
        errorPlacement: function(error, element) {
            error.addClass('text-red-500 text-sm mt-1 block'); // apply Tailwind styles
            error.insertAfter(element); // show the error below the input
        },


       submitHandler: function(form) {
            console.log("🟢 Submitting form...");
            form.submit();
        }
    });

    console.log("✅ Validator attached:");

    // Add custom regex validation - original location
    
    
}); // Delay ensures DOM is fully parsed

</script>
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection