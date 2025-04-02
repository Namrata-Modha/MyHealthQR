<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - MyHealthQR</title>

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

    <!-- ✅ Reset Container -->
    <div class="w-full max-w-sm p-6 bg-brandGrayDark bg-opacity-95 shadow-lg rounded-lg relative z-10 border border-brandGreen">
        <!-- ✅ Logo & Title -->
        <div class="text-center">
            <img src="{{ asset('images/loginBanner.jpg') }}" alt="MyHealthQR Logo"
                 class="h-16 w-full object-contain bg-brandDarkGray rounded-t-lg">
            <h2 class="text-2xl font-bold text-brandGreen mt-4">Reset Your Password</h2>
        </div>
        @if(session('success'))
            <div class="bg-green-500 text-white text-base px-4 py-2 rounded-md text-center shadow-md mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('status'))
            <div class="bg-green-500 text-white text-base px-4 py-2 rounded-md mt-4 text-center shadow-md">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="text-red-500 bg-red-100 p-3 rounded mb-4 mt-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- ✅ Reset Form -->
        <form id="resetPasswordForm" method="POST" action="{{ route('password.update') }}" class="space-y-4 mt-6">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email -->
            <div>
                <label for="email" class="block text-base text-brandGrayLight mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" readonly
                    class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight cursor-not-allowed">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- New Password -->
            <div class="relative">
                <label for="password" class="block text-base text-brandGrayLight mb-1">New Password</label>
                <input id="password" type="password" name="password"
                    class="w-full px-4 py-2 pr-12 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    placeholder="New Password">
                <button type="button" id="toggle-password"
                    class="absolute top-3/4 right-3 transform -translate-y-1/2 flex items-center h-10">
                    <i id="eye-icon" class="fa fa-eye-slash text-brandGrayLight hover:text-white transition duration-200"></i>
                </button>
                @error('password')
                    <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="relative">
                <label for="password_confirmation" class="block text-base text-brandGrayLight mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="w-full px-4 py-2 pr-12 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    placeholder="Confirm Password">
                <button type="button" id="toggle-confirm-password"
                    class="absolute top-3/4 right-3 transform -translate-y-1/2 flex items-center h-10">
                    <i id="eye-icon-confirm" class="fa fa-eye-slash text-brandGrayLight hover:text-white transition duration-200"></i>
                </button>
                @error('password_confirmation')
                    <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-brandGreen text-white py-3 rounded-lg shadow-md hover:bg-brandGreen-hover transition-transform transform hover:scale-105 duration-300">
                Reset Password
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}"
               class="inline-block text-base text-brandBlue hover:text-brandBlue-hover underline transition">
                ← Back to Login
            </a>
        </div>
    </div>

    <!-- ✅ JS Includes -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    @vite(['resources/js/passwordValidation.js'])

    <script>
        $(document).ready(function () {
            $.validator.addMethod("regex", function (value, element, pattern) {
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
                        regex: "Password must contain uppercase, lowercase, number, and special character."
                    },
                    password_confirmation: {
                        equalTo: "Passwords do not match."
                    }
                },
                errorPlacement: function (error, element) {
                    error.addClass('text-red-500 text-sm mt-1 block');
                    error.insertAfter(element);
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
