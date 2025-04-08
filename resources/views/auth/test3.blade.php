@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">

                    <form id="signupForm" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                   name="first_name" id="first_name"
                                   value="{{ old('first_name') }}" placeholder="First Name">
                            @error('first_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                   name="last_name" id="last_name"
                                   value="{{ old('last_name') }}" placeholder="Last Name">
                            @error('last_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" id="email"
                                   value="{{ old('email') }}" placeholder="Email">
                            @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" id="password" placeholder="Password">
                            @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                   name="date_of_birth" id="date_of_birth"
                                   value="{{ old('date_of_birth') }}">
                            @error('date_of_birth') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3" id="guardianConsentField" style="display: none;">
                            <label>
                                <input type="checkbox" name="guardian_consent" id="guardian_consent" value="1"
                                       {{ old('guardian_consent') ? 'checked' : '' }}>
                                I am the guardian of this user.
                            </label>
                            @error('guardian_consent') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        

                        <!-- Security Agreement Checkbox -->
                        <div class="mb-3">
                            <label>
                                <input type="checkbox" name="security_agreement_signed" id="security_agreement_signed" value="1"
                                       {{ old('security_agreement_signed') ? 'checked' : '' }}>
                                I agree to the <a href="{{ route('terms') }}" target="_blank">Terms of Service</a> and <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a> of MyHealthQR.
                            </label>
                            @error('security_agreement_signed') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- PIPEDA Consent Checkbox -->
                        <div class="mb-3">
                            <label>
                                <input type="checkbox" name="pipeda_consent" id="pipeda_consent" value="1"
                                       {{ old('pipeda_consent') ? 'checked' : '' }}>
                                       I consent to the collection and use of my personal data in compliance with <a href="https://www.priv.gc.ca/en/privacy-topics/privacy-laws-in-canada/the-personal-information-protection-and-electronic-documents-act-pipeda/pipeda_brief/" target="_blank">PIPEDA (Canadian law)</a>.
                            </label>
                            @error('pipeda_consent') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                    </form>
                    <div class="mt-3 text-center">
                        Already a user? <a href="{{ route('login.form') }}" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
    <!-- Bootstrap + jQuery Validation -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="{{ asset('js/register.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
