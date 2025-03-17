@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Medical Information</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="medicalInfoForm" action="{{ route('medical.info.update') }}" method="POST">
                        @csrf

                        <!-- Allergies -->
                        <div class="mb-3">
                            <label class="form-label">Allergies <i class="fa fa-info-circle" 
                                title="Enter allergies separated by commas (e.g., Peanuts, Dust, Pollen)"></i></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="allergies" 
                                       value="{{ old('allergies', $medicalInfo->allergies ?? '') }}">
                                <span class="input-group-text">
                                    <i class="eye-icon fas fa-eye toggle-visibility" data-field="allergies" onclick="toggleVisibility('allergies')" data-bs-toggle="tooltip" data-bs-placement="auto" title="Show or hide your allergy details. If visible, they will be displayed when your QR code is scanned."></i>
                                </span>
                            </div>
                        </div>

                        <!-- Chronic Conditions -->
                        <div class="mb-3">
                            <label class="form-label">Chronic Conditions <i class="fa fa-info-circle" 
                                title="Enter conditions separated by commas (e.g., Diabetes, Asthma, Hypertension)"></i></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="conditions" 
                                       value="{{ old('conditions', $medicalInfo->conditions ?? '') }}">
                                <span class="input-group-text">
                                    <i class="eye-icon fas fa-eye toggle-visibility" data-field="conditions" onclick="toggleVisibility('conditions')" data-bs-toggle="tooltip" data-bs-placement="auto" title="Show or hide your chronic conditions. If visible, these conditions will be shown to third parties scanning your QR code."></i>
                                </span>
                            </div>
                        </div>

                        <!-- Medications -->
                        <div class="mb-3">
                            <label class="form-label">Medications <i class="fa fa-info-circle" 
                                title="Enter medications separated by commas (e.g., Aspirin, Metformin)"></i></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="medications" 
                                       value="{{ old('medications', $medicalInfo->medications ?? '') }}">
                                <span class="input-group-text">
                                    <i class="eye-icon fas fa-eye toggle-visibility" data-field="medications" onclick="toggleVisibility('medications')" data-bs-toggle="tooltip" data-bs-placement="auto" title="Show or hide the medications you are taking. If visible, emergency responders can see them."></i>
                                </span>
                            </div>
                        </div>

                        <!-- Health Insurance -->
                        <div class="mb-3">
                            <label class="form-check-label" for="has_insurance">I have health insurance</label> 
                            <div class="input-group align-items-center">  <!-- Centering -->
                                <input type="checkbox" class="form-check-input me-2" id="has_insurance" name="has_insurance" 
                                       {{ old('has_insurance', $hasInsurance) ? 'checked' : '' }}>
                                <span class="input-group-text">
                                    <i class="eye-icon fas fa-eye toggle-visibility" data-field="has_insurance" onclick="toggleVisibility('has_insurance')" data-bs-toggle="tooltip" data-bs-placement="auto" title="Show or hide your health insurance status. If visible, responders will know whether you are insured."></i>
                                </span>
                            </div>
                        </div>

                        <!-- Quick Help -->
                        <div class="mb-3">
                            <input type="checkbox" class="form-check-input" id="quick_help_enabled" name="quick_help_enabled" 
                                   {{ old('quick_help_enabled', $healthQrEnabled) ? 'checked' : '' }}>
                            <label class="form-check-label" for="quick_help_enabled" data-bs-toggle="tooltip" data-bs-placement="auto" title="Enable or disable Quick Help. If enabled, third-party users can see your Quick Help instructions.">
                                Enable Quick Help
                            </label>
                        </div>
                        

                        <h5>Quick Help Questionaire</h5>

                        <!-- Emergency Steps -->
                        <div class="mb-3">
                            <label class="form-label">What immediate steps should be taken in case of an emergency?</label>
                            <div class="input-group">
                                <textarea class="form-control" name="quickhelp_answer_1">{{ old('quickhelp_answer_1', $medicalInfo->quickhelp_answer_1 ?? '') }}</textarea>
                                <span class="input-group-text">
                                    <i class="eye-icon fas fa-eye toggle-visibility" data-field="quickhelp_answer_1" onclick="toggleVisibility('quickhelp_answer_1')" data-bs-toggle="tooltip" data-bs-placement="auto" title="Show or hide this emergency instruction. If visible, responders will see it when scanning your QR code."></i>
                                </span>
                            </div>
                        </div>

                        <!-- Emergency Medications -->
                        <div class="mb-3">
                            <label class="form-label">What medications or treatments are needed in the emergency situation?</label>
                            <div class="input-group">
                                <textarea class="form-control" name="quickhelp_answer_2">{{ old('quickhelp_answer_2', $medicalInfo->quickhelp_answer_2 ?? '') }}</textarea>
                                <span class="input-group-text">
                                    <i class="eye-icon fas fa-eye toggle-visibility" data-field="quickhelp_answer_2" onclick="toggleVisibility('quickhelp_answer_2')" data-bs-toggle="tooltip" data-bs-placement="auto" title="Show or hide this emergency action. If visible, it will be available to those scanning your QR code."></i>
                                </span>
                            </div>
                        </div>

                        <!-- Condition Worsening -->
                        <div class="mb-3">
                            <label class="form-label">What should be done if the condition worsens?</label>
                            <div class="input-group">
                                <textarea class="form-control" name="quickhelp_answer_3">{{ old('quickhelp_answer_3', $medicalInfo->quickhelp_answer_3 ?? '') }}</textarea>
                                <span class="input-group-text">
                                    <i class="eye-icon fas fa-eye toggle-visibility" data-field="quickhelp_answer_3" onclick="toggleVisibility('quickhelp_answer_3')" data-bs-toggle="tooltip" data-bs-placement="auto" title="Show or hide this emergency guidance. If visible, responders will know what to do when scanning."></i>
                                </span>
                            </div>
                        </div>

                        <!-- Hidden Field to Store Privacy Settings -->
                        <input type="hidden" name="privacy_settings" id="privacy_settings" value="{{ $privacySettings }}">

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<style>
    .form-check-input {
        width: 1.5em;
        height: 1.5em;
        cursor: pointer;
        margin-right: 5px; /* Keep spacing correct */
    }
</style>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="{{ asset('js/global.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList1 = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList1 = tooltipTriggerList1.map(function (tooltipTriggerEl1) {
            return new bootstrap.Tooltip(tooltipTriggerEl1);
        });
    });
</script>
@endsection
