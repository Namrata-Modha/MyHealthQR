@extends('layouts.app')

@section('content')
<div class="container my-10">
    <div class="max-w-4xl mx-auto bg-brandGrayDark bg-opacity-95 shadow-lg rounded-lg border border-brandGreen p-6">
        <div class="text-center mb-6">
            <img src="{{ asset('images/loginBanner.jpg') }}" alt="MyHealthQR Logo" class="h-16 w-full object-contain bg-brandDarkGray rounded-t-lg">
            <h2 class="text-2xl font-bold text-brandGreen mt-4">Personal Information</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-500 text-white text-base px-4 py-2 rounded-md text-center shadow-md mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="bg-brandGrayMedium text-brandGrayLight text-sm p-3 rounded-md mb-4 border-l-4 border-brandGreen">
            <i class="fas fa-eye me-2 text-brandGreen"></i>
            The eye icon next to each field allows you to show or hide sensitive information for better privacy and clarity.
        </div>
        <form action="{{ route('user.profile.update') }}" method="POST" id="userProfileForm" class="space-y-4">
            @csrf

            <div>
                <label class="block text-base text-brandGrayLight mb-1">Email (Read-Only)</label>
                <input type="email" class="w-full px-4 py-2 bg-brandGrayDark text-brandGrayLight border border-brandBorder rounded-lg cursor-not-allowed" value="{{ $user->email }}" readonly>
            </div>

            <div>
                <label class="block text-base text-brandGrayLight mb-1">Date of Birth (Read-Only)</label>
                <input type="text" class="w-full px-4 py-2 bg-brandGrayDark text-brandGrayLight border border-brandBorder rounded-lg cursor-not-allowed" value="{{ $profile->date_of_birth }}" readonly>
            </div>

            <!-- First Name -->
            <div>
                <label for="first_name" class="block text-base text-brandGrayLight mb-1">First Name</label>
                <input type="text" class="w-full px-4 py-2 bg-brandGrayDark text-brandGrayLight border border-brandBorder rounded-lg @error('first_name') border-red-500 @enderror focus:ring-2 focus:ring-brandGreen focus:outline-none" name="first_name" id="first_name" value="{{ old('first_name', $profile->first_name ?? '') }}">
                @error('first_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Last Name -->
            <div>
                <label for="last_name" class="block text-base text-brandGrayLight mb-1">Last Name</label>
                <input type="text" class="w-full px-4 py-2 bg-brandGrayDark text-brandGrayLight border border-brandBorder rounded-lg @error('last_name') border-red-500 @enderror focus:ring-2 focus:ring-brandGreen focus:outline-none" name="last_name" id="last_name" value="{{ old('last_name', $profile->last_name ?? '') }}">
                @error('last_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Contact Phone -->
            <div>
                <label for="contact_phone" class="block text-base text-brandGrayLight mb-1">Contact Phone</label>
                <div class="input-group flex">
                    <input type="text" class="form-control h-[46px] px-4 bg-brandGrayDark text-brandGrayLight border border-brandBorder rounded-l-lg @error('contact_phone') border-red-500 @enderror focus:ring-2 focus:ring-brandGreen focus:outline-none w-full" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $profile->contact_phone ?? '') }}">
                    <span class="input-group-text h-[46px] px-4 bg-brandGrayDark border border-l-0 border-brandBorder rounded-r-lg flex items-center">
                        <i class="eye-icon fas fa-eye toggle-visibility text-brandGrayLight hover:text-white transition duration-200" data-field="contact_phone" onclick="toggleVisibility('contact_phone')" data-bs-toggle="tooltip" title="Show or hide your contact number. If visible, third parties can see it when scanning your QR code"></i>
                    </span>
                </div>
                @error('contact_phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Emergency Contact Name -->
            <div>
                <label for="emergency_contact_name" class="block text-base text-brandGrayLight mb-1">Emergency Contact Name</label>
                <div class="input-group flex">
                    <input type="text" class="form-control h-[46px] px-4 bg-brandGrayDark text-brandGrayLight border border-brandBorder rounded-l-lg @error('emergency_contact_name') border-red-500 @enderror focus:ring-2 focus:ring-brandGreen focus:outline-none w-full" name="emergency_contact_name" id="emergency_contact_name" value="{{ old('emergency_contact_name', $profile->emergency_contact_name ?? '') }}">
                    <span class="input-group-text h-[46px] px-4 bg-brandGrayDark border border-l-0 border-brandBorder rounded-r-lg flex items-center">
                        <i class="eye-icon fas fa-eye toggle-visibility text-brandGrayLight hover:text-white transition duration-200" data-field="emergency_contact_name" onclick="toggleVisibility('emergency_contact_name')" data-bs-toggle="tooltip" title="Show or hide your emergency contact's name. If visible, it will be available when your QR code is scanned."></i>
                    </span>
                </div>
                @error('emergency_contact_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Emergency Contact Phone -->
            <div>
                <label for="emergency_contact_phone" class="block text-base text-brandGrayLight mb-1">Emergency Contact Phone</label>
                <div class="input-group flex">
                    <input type="text" class="form-control h-[46px] px-4 bg-brandGrayDark text-brandGrayLight border border-brandBorder rounded-l-lg @error('emergency_contact_phone') border-red-500 @enderror focus:ring-2 focus:ring-brandGreen focus:outline-none w-full" name="emergency_contact_phone" id="emergency_contact_phone" value="{{ old('emergency_contact_phone', $profile->emergency_contact_phone ?? '') }}">
                    <span class="input-group-text h-[46px] px-4 bg-brandGrayDark border border-l-0 border-brandBorder rounded-r-lg flex items-center">
                        <i class="eye-icon fas fa-eye toggle-visibility text-brandGrayLight hover:text-white transition duration-200" data-field="emergency_contact_phone" onclick="toggleVisibility('emergency_contact_phone')" data-bs-toggle="tooltip" title="Show or hide your emergency contact’s phone number. If visible, others can call them in an emergency."></i>
                    </span>
                </div>
                @error('emergency_contact_phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <input type="hidden" name="privacy_settings" id="privacy_settings" value="{{ $privacySettings }}">

            <button type="submit" class="w-full bg-brandGreen text-white py-3 rounded-lg shadow-md hover:bg-brandGreen-hover transition-transform transform hover:scale-105 duration-300">
                Save Changes
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/global.js') }}"></script>
<script src="{{ asset('js/user_profile.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Optional: Hide tooltips after a short delay
        document.body.addEventListener('click', function () {
            setTimeout(() => {
                tooltipTriggerList.forEach(el => {
                    bootstrap.Tooltip.getInstance(el)?.hide();
                });
            }, 1000);
        });
    });
</script>
@endsection
