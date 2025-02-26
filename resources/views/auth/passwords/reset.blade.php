@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reset Password</h2>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form id="resetPasswordForm" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Email (Read-only) -->
        <div class="mb-3">
            <label>Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" readonly>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- New Password -->
        <div class="mb-3">
            <label>New Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label>Confirm Password <span class="text-danger">*</span></label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
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
        submitHandler: function(form) {
            form.submit();
        }
    });

    // Add custom regex validation
    $.validator.addMethod("regex", function(value, element, pattern) {
        return this.optional(element) || new RegExp(pattern).test(value);
    });
});
</script>
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection