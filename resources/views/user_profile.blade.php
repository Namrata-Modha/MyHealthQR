@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Personal Information</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('user.profile.update') }}" method="POST" id="userProfileForm">
                        @csrf

                        <!-- Email (Read-Only) -->
                        <div class="mb-3">
                            <label class="form-label">Email (Read-Only)</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>

                        <!-- Date of Birth (Read-Only) -->
                        <div class="mb-3">
                            <label class="form-label">Date of Birth (Read-Only)</label>
                            <input type="text" class="form-control" value="{{ $profile->date_of_birth }}" readonly>
                        </div>

                        <!-- First Name -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                       name="first_name" id="first_name"
                                       value="{{ old('first_name', $profile->first_name ?? '') }}">
                            </div>
                            @error('first_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                       name="last_name" id="last_name"
                                       value="{{ old('last_name', $profile->last_name ?? '') }}">
                            </div>
                            @error('last_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <!-- Contact Phone -->
                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">Contact Phone</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('contact_phone') is-invalid @enderror"
                                       name="contact_phone" id="contact_phone"
                                       value="{{ old('contact_phone', $profile->contact_phone ?? '') }}">
                                <span class="input-group-text">
                                    <i class="eye-icon fas fa-eye toggle-visibility" data-field="contact_phone" onclick="toggleVisibility('contact_phone')"></i>
                                </span>
                            </div>
                            @error('contact_phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <!-- Emergency Contact Name -->
                        <div class="mb-3">
                            <label for="emergency_contact_name" class="form-label">Emergency Contact Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror"
                                       name="emergency_contact_name" id="emergency_contact_name"
                                       value="{{ old('emergency_contact_name', $profile->emergency_contact_name ?? '') }}">
                                <span class="input-group-text">
                                    <i class="eye-icon fas fa-eye toggle-visibility" data-field="emergency_contact_name" onclick="toggleVisibility('emergency_contact_name')"></i>
                                </span>
                            </div>
                            @error('emergency_contact_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <!-- Emergency Contact Phone -->
                        <div class="mb-3">
                            <label for="emergency_contact_phone" class="form-label">Emergency Contact Phone</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('emergency_contact_phone') is-invalid @enderror"
                                       name="emergency_contact_phone" id="emergency_contact_phone"
                                       value="{{ old('emergency_contact_phone', $profile->emergency_contact_phone ?? '') }}">
                                <span class="input-group-text">
                                    <i class="eye-icon fas fa-eye toggle-visibility" data-field="emergency_contact_phone" onclick="toggleVisibility('emergency_contact_phone')"></i>
                                </span>
                            </div>
                            @error('emergency_contact_phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <!-- Hidden Field to Store Privacy Settings -->
                        <input type="hidden" name="privacy_settings" id="privacy_settings" value="{{ $privacySettings }}">

                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="{{ asset('js/global.js') }}"></script>
<script src="{{ asset('js/user_profile.js') }}"></script>
@endsection
