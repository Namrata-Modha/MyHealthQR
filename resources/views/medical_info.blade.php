@extends('layouts.app')

@section('content')
<div class="container my-10">
    <div class="max-w-4xl mx-auto bg-brandGrayDark bg-opacity-95 shadow-lg rounded-lg border border-brandGreen p-6">
        <div class="text-center mb-6">
            <img src="{{ asset('images/loginBanner.jpg') }}" alt="MyHealthQR Logo" class="h-16 w-full object-contain bg-brandDarkGray rounded-t-lg">
            <h2 class="text-2xl font-bold text-brandGreen mt-4">Medical Information</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-500 text-white text-base px-4 py-2 rounded-md text-center shadow-md mb-4">
                {{ session('success') }}
            </div>
        @endif
        <!-- Explanation Note for Eye Icons -->
        <div class="bg-brandGrayMedium text-brandGrayLight text-sm p-3 rounded-md mb-4 border-l-4 border-brandGreen">
            <i class="fas fa-eye me-2 text-brandGreen"></i>
            The eye icon next to each field allows you to show or hide sensitive information for better privacy and clarity.
        </div>
        <form id="medicalInfoForm" action="{{ route('medical.info.update') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Allergies -->
            <div>
                <label class="block text-base text-brandGrayLight mb-1">Allergies <i class="fa fa-info-circle" title="Enter allergies separated by commas (e.g., Peanuts, Dust, Pollen)"></i></label>
                <div class="input-group flex">
                    <input type="text" class="form-control h-[46px] px-4 bg-brandGrayDark text-brandGrayLight border border-brandBorder rounded-l-lg w-full focus:ring-2 focus:ring-brandGreen focus:outline-none" name="allergies" value="{{ old('allergies', $medicalInfo->allergies ?? '') }}">
                    <span class="input-group-text h-[46px] px-4 bg-brandGrayDark border border-l-0 border-brandBorder rounded-r-lg flex items-center">
                        <i class="eye-icon fas fa-eye toggle-visibility text-brandGrayLight hover:text-white transition duration-200" data-field="allergies" onclick="toggleVisibility('allergies')" data-bs-toggle="tooltip" title="Show or hide your allergy details."></i>
                    </span>
                </div>
            </div>

            <!-- Chronic Conditions -->
            <div>
                <label class="block text-base text-brandGrayLight mb-1">Chronic Conditions <i class="fa fa-info-circle" title="Enter conditions separated by commas (e.g., Diabetes, Asthma, Hypertension)"></i></label>
                <div class="input-group flex">
                    <input type="text" class="form-control h-[46px] px-4 bg-brandGrayDark text-brandGrayLight border border-brandBorder rounded-l-lg w-full focus:ring-2 focus:ring-brandGreen focus:outline-none" name="conditions" value="{{ old('conditions', $medicalInfo->conditions ?? '') }}">
                    <span class="input-group-text h-[46px] px-4 bg-brandGrayDark border border-l-0 border-brandBorder rounded-r-lg flex items-center">
                        <i class="eye-icon fas fa-eye toggle-visibility text-brandGrayLight hover:text-white transition duration-200" data-field="conditions" onclick="toggleVisibility('conditions')" data-bs-toggle="tooltip" title="Show or hide your chronic conditions."></i>
                    </span>
                </div>
            </div>

            <!-- Medications -->
            <div>
                <label class="block text-base text-brandGrayLight mb-1">Medications <i class="fa fa-info-circle" title="Enter medications separated by commas (e.g., Aspirin, Metformin)"></i></label>
                <div class="input-group flex">
                    <input type="text" class="form-control h-[46px] px-4 bg-brandGrayDark text-brandGrayLight border border-brandBorder rounded-l-lg w-full focus:ring-2 focus:ring-brandGreen focus:outline-none" name="medications" value="{{ old('medications', $medicalInfo->medications ?? '') }}">
                    <span class="input-group-text h-[46px] px-4 bg-brandGrayDark border border-l-0 border-brandBorder rounded-r-lg flex items-center">
                        <i class="eye-icon fas fa-eye toggle-visibility text-brandGrayLight hover:text-white transition duration-200" data-field="medications" onclick="toggleVisibility('medications')" data-bs-toggle="tooltip" title="Show or hide the medications you are taking."></i>
                    </span>
                </div>
            </div>

            <!-- Health Insurance -->
            <div>
                <label class="block text-base text-brandGrayLight mb-1">Health Insurance</label>
                <div class="flex items-center gap-3">
                    <input type="checkbox" class="form-check-input" id="has_insurance" name="has_insurance" {{ old('has_insurance', $hasInsurance) ? 'checked' : '' }}>
                    <label for="has_insurance" class="text-brandGrayLight">I have health insurance</label>
                    <span class="input-group-text h-[46px] px-4 bg-brandGrayDark border border-brandBorder rounded-lg flex items-center">
                        <i class="eye-icon fas fa-eye toggle-visibility text-brandGrayLight hover:text-white transition duration-200" data-field="has_insurance" onclick="toggleVisibility('has_insurance')" data-bs-toggle="tooltip" title="Show or hide your health insurance status."></i>
                    </span>
                </div>
            </div>

            <!-- Quick Help Toggle -->
            <div>
                <div class="flex items-center gap-3">
                    <input type="checkbox" class="form-check-input" id="quick_help_enabled" name="quick_help_enabled" {{ old('quick_help_enabled', $healthQrEnabled) ? 'checked' : '' }}>
                    <label for="quick_help_enabled" class="text-brandGrayLight" data-bs-toggle="tooltip" title="Enable or disable Quick Help.">
                        Enable Quick Help
                    </label>
                </div>
            </div>

            <!-- Quick Help Questions -->
            <h5 class="text-lg font-semibold text-brandGreen mt-4">Quick Help Questionnaire</h5>

            <div>
                <label class="block text-base text-brandGrayLight mb-1">Emergency Steps</label>
                <div class="input-group flex">
                    <textarea class="form-control px-4 py-2 h-[100px] bg-brandGrayDark text-brandGrayLight border border-brandBorder rounded-l-lg w-full focus:ring-2 focus:ring-brandGreen focus:outline-none" name="quickhelp_answer_1">{{ old('quickhelp_answer_1', $medicalInfo->quickhelp_answer_1 ?? '') }}</textarea>
                    <span class="input-group-text px-4 bg-brandGrayDark border border-l-0 border-brandBorder rounded-r-lg flex items-center">
                        <i class="eye-icon fas fa-eye toggle-visibility text-brandGrayLight hover:text-white transition duration-200" data-field="quickhelp_answer_1" onclick="toggleVisibility('quickhelp_answer_1')" data-bs-toggle="tooltip" title="Show or hide this emergency instruction."></i>
                    </span>
                </div>
            </div>

            <div>
                <label class="block text-base text-brandGrayLight mb-1">Emergency Medications</label>
                <div class="input-group flex">
                    <textarea class="form-control px-4 py-2 h-[100px] bg-brandGrayDark text-brandGrayLight border border-brandBorder rounded-l-lg w-full focus:ring-2 focus:ring-brandGreen focus:outline-none" name="quickhelp_answer_2">{{ old('quickhelp_answer_2', $medicalInfo->quickhelp_answer_2 ?? '') }}</textarea>
                    <span class="input-group-text px-4 bg-brandGrayDark border border-l-0 border-brandBorder rounded-r-lg flex items-center">
                        <i class="eye-icon fas fa-eye toggle-visibility text-brandGrayLight hover:text-white transition duration-200" data-field="quickhelp_answer_2" onclick="toggleVisibility('quickhelp_answer_2')" data-bs-toggle="tooltip" title="Show or hide this emergency action."></i>
                    </span>
                </div>
            </div>

            <div>
                <label class="block text-base text-brandGrayLight mb-1">Worsening Condition Instructions</label>
                <div class="input-group flex">
                    <textarea class="form-control px-4 py-2 h-[100px] bg-brandGrayDark text-brandGrayLight border border-brandBorder rounded-l-lg w-full focus:ring-2 focus:ring-brandGreen focus:outline-none" name="quickhelp_answer_3">{{ old('quickhelp_answer_3', $medicalInfo->quickhelp_answer_3 ?? '') }}</textarea>
                    <span class="input-group-text px-4 bg-brandGrayDark border border-l-0 border-brandBorder rounded-r-lg flex items-center">
                        <i class="eye-icon fas fa-eye toggle-visibility text-brandGrayLight hover:text-white transition duration-200" data-field="quickhelp_answer_3" onclick="toggleVisibility('quickhelp_answer_3')" data-bs-toggle="tooltip" title="Show or hide this emergency guidance."></i>
                    </span>
                </div>
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
<script src="{{ asset('js/global.js') }}"></script>
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
            }, 100);
        });
    });
</script>
@endsection
